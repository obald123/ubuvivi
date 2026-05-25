<?php

namespace App\Http\Controllers\Concerns;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait UploadsImages
{
    /**
     * Upload a single file: try Cloudinary first, fall back to public disk.
     * Always returns a URL string, or null if both methods fail.
     */
    protected function uploadImage(UploadedFile $file, string $folder = 'ubuvivi'): ?string
    {
        Log::info('--- UPLOAD START ---');
        Log::info('File Name: ' . $file->getClientOriginalName());
        Log::info('File Size: ' . $file->getSize());
        Log::info('File Mime: ' . $file->getMimeType());
        Log::info('Target Folder: ' . $folder);

        // 1 — Try Cloudinary
        try {
            $cloudUrl = env('CLOUDINARY_URL');
            Log::info('CLOUDINARY_URL check: ' . ($cloudUrl ? 'Set' : 'NOT SET'));
            
            Log::info('Calling Cloudinary::upload...');
            $result = Cloudinary::upload($file->getRealPath(), ['folder' => $folder]);
            if ($result) {
                Log::info('Cloudinary upload successful: ' . $result->getSecurePath());
                return $result->getSecurePath();
            }
            Log::warning('Cloudinary::upload returned empty result (no exception)');
        } catch (\Throwable $e) {
            Log::error('Cloudinary upload exception: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }

        // 2 — Fallback: public disk (storage/app/public)
        Log::info('Falling back to local storage...');
        try {
            $path = $file->store('uploads/' . date('Y/m'), 'public');
            Log::info('File stored at: ' . $path);
            $url = Storage::disk('public')->url($path);
            Log::info('Generated URL: ' . $url);
            return $url;
        } catch (\Throwable $e) {
            Log::error('Local storage fallback also failed: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }

        Log::error('--- UPLOAD FAILED COMPLETELY ---');
        return null;
    }

    /**
     * Upload multiple files from a request field.
     * Returns [urls[], publicIds[]] — publicId is null for local files.
     */
    protected function uploadImages(\Illuminate\Http\Request $request, string $fieldName, string $folder = 'ubuvivi'): array
    {
        $urls = [];
        $ids  = [];

        if (!$request->hasFile($fieldName)) {
            Log::info('No files found in request field: ' . $fieldName);
            return [$urls, $ids];
        }

        $files = $request->file($fieldName);
        Log::info('Attempting multiple images upload for field: ' . $fieldName . ' (Count: ' . (is_array($files) ? count($files) : 1) . ')');

        foreach ((array) $files as $file) {
            if (!$file || !($file instanceof UploadedFile) || !$file->isValid()) {
                Log::warning('Invalid file encountered in uploadImages', ['file' => $file]);
                continue;
            }

            // Try Cloudinary
            try {
                $result = Cloudinary::upload($file->getRealPath(), ['folder' => $folder]);
                if ($result) {
                    $urls[] = $result->getSecurePath();
                    $ids[]  = $result->getPublicId();
                    Log::info('Cloudinary multiple upload successful: ' . $result->getSecurePath());
                    continue;
                }
                Log::warning('Cloudinary multiple upload returned empty result');
            } catch (\Throwable $e) {
                Log::error('Cloudinary multiple upload exception: ' . $e->getMessage(), ['exception' => $e]);
            }

            // Fallback: local disk
            try {
                $path   = $file->store('uploads/' . date('Y/m'), 'public');
                $url    = Storage::disk('public')->url($path);
                $urls[] = $url;
                $ids[]  = null;
                Log::info('Fallback local multiple upload successful: ' . $url);
            } catch (\Throwable $e) {
                Log::error('Local storage multiple fallback failed: ' . $e->getMessage(), ['exception' => $e]);
            }
        }

        return [$urls, $ids];
    }
}
