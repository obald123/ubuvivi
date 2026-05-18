<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::withTrashed()->latest()->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'stars'         => 'required|integer|min:1|max:5',
            'price_per_night' => 'nullable|numeric|min:0',
            'images.*'      => 'nullable|image|max:4096',
        ]);

        [$images, $imageIds] = $this->uploadImages($request, 'images');

        Hotel::create([
            'name'           => $request->name,
            'location'       => $request->location,
            'description'    => $request->description,
            'stars'          => $request->stars,
            'price_per_night'=> $request->price_per_night,
            'images'         => $images,
            'image_ids'      => $imageIds,
            'amenities'      => $this->parseAmenities($request->amenities),
            'available'      => $request->boolean('available', true),
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel added successfully.');
    }

    public function getData($id)
    {
        $hotel = Hotel::withTrashed()->findOrFail($id);
        return response()->json([
            'id'             => $hotel->id,
            'name'           => $hotel->name,
            'location'       => $hotel->location,
            'description'    => $hotel->description,
            'stars'          => $hotel->stars,
            'price_per_night'=> $hotel->price_per_night,
            'images'         => $hotel->images ?? [],
            'amenities'      => implode(', ', $hotel->amenities ?? []),
            'available'      => $hotel->available,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'location'      => 'required|string|max:255',
            'stars'         => 'required|integer|min:1|max:5',
            'price_per_night' => 'nullable|numeric|min:0',
            'images.*'      => 'nullable|image|max:4096',
        ]);

        $hotel = Hotel::withTrashed()->findOrFail($id);

        [$newImages, $newIds] = $this->uploadImages($request, 'images');
        $images   = array_merge($hotel->images ?? [], $newImages);
        $imageIds = array_merge($hotel->image_ids ?? [], $newIds);

        $hotel->update([
            'name'           => $request->name,
            'location'       => $request->location,
            'description'    => $request->description,
            'stars'          => $request->stars,
            'price_per_night'=> $request->price_per_night,
            'images'         => $images,
            'image_ids'      => $imageIds,
            'amenities'      => $this->parseAmenities($request->amenities),
            'available'      => $request->boolean('available', true),
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hotel updated.');
    }

    public function destroy($id)
    {
        Hotel::findOrFail($id)->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hotel removed.');
    }

    private function uploadImages(Request $request, string $field): array
    {
        $images = [];
        $ids    = [];
        if ($request->hasFile($field)) {
            foreach ($request->file($field) as $file) {
                try {
                    $result   = Cloudinary::upload($file->getRealPath(), ['folder' => 'ubuvivi/hotels']);
                    $images[] = $result->getSecurePath();
                    $ids[]    = $result->getPublicId();
                } catch (\Throwable $e) {}
            }
        }
        return [$images, $ids];
    }

    private function parseAmenities(?string $raw): array
    {
        if (!$raw) return [];
        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }
}
