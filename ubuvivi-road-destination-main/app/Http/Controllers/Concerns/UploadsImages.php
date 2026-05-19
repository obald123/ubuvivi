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
        // 1 — Try Cloudinary
        try {
            $result = Cloudinary::upload($file->getRealPath(), ['folder' => $folder]);
            if ($result) {
                return $result->getSecurePath();
            }
        } catch (\Throwable $e) {
            Log::warning('Cloudinary upload failed, falling back to local storage: ' . $e->getMessage());
        }

        // 2 — Fallback: public disk (storage/app/public)
        try {
            $path = $file->store('uploads/' . date('Y/m'), 'public');
            return Storage::disk('public')->url($path);
        } catch (\Throwable $e) {
            Log::error('Local storage fallback also failed: ' . $e->getMessage());
        }

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
            return [$urls, $ids];
        }

        foreach ((array) $request->file($fieldName) as $file) {
            if (!$file || !($file instanceof UploadedFile) || !$file->isValid()) {
                continue;
            }

            // Try Cloudinary
            try {
                $result = Cloudinary::upload($file->getRealPath(), ['folder' => $folder]);
                if ($result) {
                    $urls[] = $result->getSecurePath();
                    $ids[]  = $result->getPublicId();
                    continue;
                }
            } catch (\Throwable $e) {
                Log::warning('Cloudinary upload failed: ' . $e->getMessage());
            }

            // Fallback: local disk
            try {
                $path   = $file->store('uploads/' . date('Y/m'), 'public');
                $urls[] = Storage::disk('public')->url($path);
                $ids[]  = null;
            } catch (\Throwable $e) {
                Log::error('Local storage fallback failed: ' . $e->getMessage());
            }
        }

        return [$urls, $ids];
    }
}
