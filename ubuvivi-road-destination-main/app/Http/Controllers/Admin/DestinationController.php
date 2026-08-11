<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Concerns\UploadsImages;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    use UploadsImages;

    public function index()
    {
        $destinations = Destination::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.destinations.index', compact('destinations'));
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());

        Destination::create([
            'name'       => $request->name,
            'tag'        => $request->tag ?: 'Rwanda',
            'image'      => $this->firstUploadedImage($request),
            'image_id'   => $this->lastImageId,
            'nearby'     => $this->cleanNearby($request->input('nearby', [])),
            'sort_order' => (int) $request->input('sort_order', 0),
            'active'     => $request->boolean('active', true),
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination added successfully.');
    }

    public function getData($id)
    {
        $destination = Destination::withTrashed()->findOrFail($id);

        return response()->json([
            'id'         => $destination->id,
            'name'       => $destination->name,
            'tag'        => $destination->tag,
            'image'      => $destination->image_url,
            'nearby'     => $destination->nearby ?? [],
            'sort_order' => $destination->sort_order,
            'active'     => $destination->active,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->rules($id));

        $destination = Destination::withTrashed()->findOrFail($id);

        $data = [
            'name'       => $request->name,
            'tag'        => $request->tag ?: 'Rwanda',
            'nearby'     => $this->cleanNearby($request->input('nearby', []), $destination->id),
            'sort_order' => (int) $request->input('sort_order', 0),
            'active'     => $request->boolean('active', true),
        ];

        // Only replace the image when a new file was actually supplied.
        $uploaded = $this->firstUploadedImage($request);

        if ($uploaded) {
            $data['image']    = $uploaded;
            $data['image_id'] = $this->lastImageId;
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Destination updated.');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);

        // Drop this destination from everyone else's "nearby" list so the
        // suggestions never point at something that is gone.
        Destination::all()->each(function ($other) use ($destination) {
            $nearby = $other->nearby ?? [];

            if (in_array($destination->id, $nearby)) {
                $other->update(['nearby' => array_values(array_diff($nearby, [$destination->id]))]);
            }
        });

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destination removed.');
    }

    private function rules($ignoreId = null): array
    {
        return [
            'name'       => 'required|string|max:255|unique:destinations,name' . ($ignoreId ? ',' . $ignoreId : ''),
            'tag'        => 'nullable|string|max:255',
            'image'      => 'nullable|image|max:4096',
            'nearby'     => 'nullable|array',
            'nearby.*'   => 'integer|exists:destinations,id',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }

    /** Public id of the most recent upload, set by firstUploadedImage(). */
    private $lastImageId = null;

    private function firstUploadedImage(Request $request): ?string
    {
        $this->lastImageId = null;

        if (!$request->hasFile('image')) {
            return null;
        }

        [$urls, $ids] = $this->uploadImages($request, 'image', 'ubuvivi/destinations');

        $this->lastImageId = $ids[0] ?? null;

        return $urls[0] ?? null;
    }

    /** Keep only valid ids, drop duplicates and any self-reference. */
    private function cleanNearby($nearby, $selfId = null): array
    {
        return collect((array) $nearby)
            ->map(function ($id) { return (int) $id; })
            ->filter(function ($id) use ($selfId) { return $id > 0 && $id !== (int) $selfId; })
            ->unique()
            ->values()
            ->all();
    }
}
