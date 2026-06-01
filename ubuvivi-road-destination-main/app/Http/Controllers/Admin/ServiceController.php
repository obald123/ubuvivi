<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Itinerary;
use App\Models\Vehicle;
use App\Models\Transfer;
use App\Models\Event;
use App\Models\Types\Transmission;
use App\Models\Types\FuelType;
use App\Models\Types\VehicleBrand;
use App\Models\Types\VehicleModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Controllers\Concerns\UploadsImages;

class ServiceController extends Controller
{
    use UploadsImages;
    public function index()
    {
        $tours = Itinerary::all();
        $vehicles = Vehicle::with(['brand', 'model', 'transmission', 'fuelType'])->get();
        $transfers = Transfer::with(['vehicle', 'driver'])->get();
        $events = Event::all();

        return view('admin.services.index', compact('tours', 'vehicles', 'transfers', 'events'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function getData($type, $id)
    {
        switch ($type) {
            case 'tour':
                $tour = Itinerary::find($id);
                if (!$tour) return response()->json(['error' => 'Not found'], 404);

                $highlights = is_array($tour->highlights) ? $tour->highlights : [];
                $inclusions = is_array($tour->inclusions) ? $tour->inclusions : [];
                $exclusions = is_array($tour->exclusions) ? $tour->exclusions : [];
                $incText = implode(', ', array_filter(array_map(fn($i) => is_array($i) ? ($i['title'] ?? '') : $i, $inclusions)));
                $excText = implode(', ', array_filter(array_map(fn($i) => is_array($i) ? ($i['title'] ?? '') : $i, $exclusions)));
                $images = is_array($tour->images) ? $tour->images : [];

                return response()->json([
                    'id'          => $tour->id,
                    'title'       => $tour->title,
                    'days'        => $tour->days ?? 1,
                    'description' => $tour->description,
                    'inclusions'  => $incText,
                    'exclusions'  => $excText,
                    'highlights'  => $highlights,
                    'images'      => $images,
                    'price'       => $tour->price ?? 0,
                ]);

            case 'car':
                $vehicle = Vehicle::with(['brand', 'model', 'transmission', 'fuelType'])->find($id);
                if (!$vehicle) return response()->json(['error' => 'Not found'], 404);

                $images   = is_array($vehicle->images) ? $vehicle->images : [];
                $imageIds = is_array($vehicle->image_id) ? $vehicle->image_id : [];

                return response()->json([
                    'id'           => $vehicle->id,
                    'car_name'     => trim(($vehicle->brand->name ?? '') . ' ' . ($vehicle->model->name ?? '')),
                    'year'         => $vehicle->production_year,
                    'transmission' => $vehicle->transmission->name ?? '',
                    'fuel_type'    => $vehicle->fuelType->name ?? '',
                    'images'       => $images,
                    'image_id'     => $imageIds,
                    'price'        => $vehicle->price ?? 100,
                    'available'    => (bool) ($vehicle->for_sale ?? false),
                ]);

            default:
                return response()->json(['error' => 'Unknown type'], 400);
        }
    }

    public function store(Request $request)
    {
        $type = $request->service_type;

        $this->validateServiceRequest($request, $type);

        try {
            switch ($type) {
                case 'tour':
                    [$images, $imageIds] = $this->uploadImages($request, 'tour_images');
                    $highlights = $this->processHighlights($request);
                    $inclusions = $this->processInclusions($request->inclusions ?? '');
                    $exclusions = $this->processInclusions($request->exclusions ?? '');

                    Itinerary::create([
                        'title'            => $request->title,
                        'days'             => (int) ($request->days ?? 1),
                        'description'      => $request->description,
                        'images'           => json_encode($images),
                        'image_id'         => json_encode($imageIds),
                        'highlights'       => json_encode($highlights),
                        'inclusions'       => json_encode($inclusions),
                        'exclusions'       => json_encode($exclusions),
                        'days_description' => json_encode([]),
                        'price'            => (int) ($request->price ?? 0),
                    ]);
                    break;

                case 'car':
                    [$images, $imageIds] = $this->uploadImages($request, 'vehicle_images');
                    $transmission = Transmission::firstOrCreate(['name' => trim($request->transmission ?? 'Manual')]);
                    $fuelType     = FuelType::firstOrCreate(['name' => trim($request->fuel_type ?? 'Petrol')]);
                    $brand        = VehicleBrand::firstOrCreate(['name' => trim($request->car_name ?? 'Unknown')]);
                    $model        = VehicleModel::firstOrCreate(['name' => trim($request->car_name ?? 'Unknown'), 'brand_id' => $brand->id]);

                    Vehicle::create([
                        'brand_id'        => $brand->id,
                        'model_id'        => $model->id,
                        'production_year' => $request->year ?? date('Y'),
                        'plate_number'    => 'SVC-' . rand(1000, 9999),
                        'seats'           => 4,
                        'price'           => (int) ($request->price ?? 100),
                        'currency'        => 'USD',
                        'transmission_id' => $transmission->id,
                        'fuel_type_id'    => $fuelType->id,
                        'description'     => $request->car_name ?? '',
                        'images'          => json_encode($images),
                        'image_id'        => json_encode($imageIds),
                        'one_day_caution' => 0,
                        'approved'        => true,
                        'for_sale'        => $request->has('available'),
                    ]);
                    break;

                case 'transfer':
                    Transfer::create([
                        'pickup_location' => $request->title,
                        'destination'     => 'Airport Transfer',
                        'pickup_date'     => now()->format('Y-m-d'),
                        'pickup_time'     => now()->format('H:i'),
                        'number_of_days'  => 1,
                        'message'         => $request->description,
                        'price'           => $request->price ?? 0,
                        'approved'        => true,
                        'transfer_type'   => 'airport',
                    ]);
                    break;

                case 'event':
                    Event::create([
                        'title'       => $request->title,
                        'price'       => $request->price ?? 0,
                        'description' => $request->description,
                        'event_type'  => 'corporate',
                        'location'    => 'Kigali',
                        'start_date'  => now()->addDays(7)->format('Y-m-d'),
                        'end_date'    => now()->addDays(14)->format('Y-m-d'),
                        'capacity'    => 100,
                    ]);
                    break;
            }

            return redirect()->route('services.index')->with('success', ucfirst($type) . ' service created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Failed to create service: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.services.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $type = $request->service_type;

        $this->validateServiceRequest($request, $type);

        try {
            switch ($type) {
                case 'tour':
                    $tour = Itinerary::findOrFail($id);
                    [$newImages, $newImageIds] = $this->uploadImages($request, 'tour_images');

                    $existingImages = json_decode($request->existing_images ?? '[]', true) ?: [];
                    $existingIds    = json_decode($request->existing_image_ids ?? '[]', true) ?: [];
                    $allImages      = array_merge($existingImages, $newImages);
                    $allImageIds    = array_merge($existingIds, $newImageIds);

                    $highlights = $this->processHighlights($request, $tour->highlights);
                    $inclusions = $this->processInclusions($request->inclusions ?? '');
                    $exclusions = $this->processInclusions($request->exclusions ?? '');

                    $tour->update([
                        'title'       => $request->title,
                        'days'        => (int) ($request->days ?? 1),
                        'description' => $request->description,
                        'images'      => json_encode($allImages),
                        'image_id'    => json_encode($allImageIds),
                        'highlights'  => json_encode($highlights),
                        'inclusions'  => json_encode($inclusions),
                        'exclusions'  => json_encode($exclusions),
                        'price'       => (int) ($request->price ?? 0),
                    ]);
                    break;

                case 'car':
                    $vehicle = Vehicle::findOrFail($id);
                    [$newImages, $newImageIds] = $this->uploadImages($request, 'vehicle_images');

                    $existingImages = json_decode($request->existing_images ?? '[]', true) ?: [];
                    $existingIds    = json_decode($request->existing_image_ids ?? '[]', true) ?: [];
                    $allImages      = array_merge($existingImages, $newImages);
                    $allImageIds    = array_merge($existingIds, $newImageIds);

                    $transmission = Transmission::firstOrCreate(['name' => trim($request->transmission ?? 'Manual')]);
                    $fuelType     = FuelType::firstOrCreate(['name' => trim($request->fuel_type ?? 'Petrol')]);

                    $vehicle->update([
                        'production_year' => $request->year ?? $vehicle->production_year,
                        'transmission_id' => $transmission->id,
                        'fuel_type_id'    => $fuelType->id,
                        'description'     => $request->car_name ?? $vehicle->description,
                        'price'           => (int) ($request->price ?? $vehicle->price),
                        'images'          => json_encode($allImages),
                        'image_id'        => json_encode($allImageIds),
                        'for_sale'        => $request->has('available'),
                    ]);
                    break;

                case 'transfer':
                    $service = Transfer::findOrFail($id);
                    $service->update([
                        'pickup_location' => $request->title,
                        'message'         => $request->description,
                        'price'           => $request->price ?? $service->price,
                    ]);
                    break;

                case 'event':
                    $service = Event::findOrFail($id);
                    $service->update([
                        'title'       => $request->title,
                        'price'       => $request->price ?? $service->price,
                        'description' => $request->description,
                    ]);
                    break;
            }

            return redirect()->route('services.index')->with('success', ucfirst($type) . ' service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $modelMap = [
            'tour'     => Itinerary::class,
            'car'      => Vehicle::class,
            'transfer' => Transfer::class,
            'event'    => Event::class,
        ];

        $type = $request->input('service_type');

        if (!$type || !isset($modelMap[$type])) {
            return redirect()->route('services.index')->with('error', 'Unknown service type.');
        }

        try {
            $modelMap[$type]::findOrFail($id)->delete();
            return redirect()->route('services.index')->with('success', ucfirst($type) . ' deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('services.index')->with('error', 'Failed to delete: ' . $e->getMessage());
        }
    }

    private function processInclusions(string $raw): array
    {
        $items = [];
        foreach (array_filter(array_map('trim', explode(',', $raw))) as $inc) {
            $items[] = ['title' => $inc];
        }
        return $items;
    }

    private function processHighlights(Request $request, $existingHighlights = []): array
    {
        $titles = $request->input('highlight_title', []);
        $descs  = $request->input('highlight_desc', []);
        $existing = is_array($existingHighlights) ? $existingHighlights : [];
        $highlights = [];

        foreach ($titles as $i => $title) {
            if (empty(trim($title))) continue;

            $h = [
                'title'       => trim($title),
                'description' => trim($descs[$i] ?? ''),
                'image'       => $existing[$i]['image'] ?? '',
            ];

            if ($request->hasFile("highlight_image_{$i}")) {
                $file = $request->file("highlight_image_{$i}");
                if ($file && $file->isValid()) {
                    $url = $this->uploadImage($file, 'ubuvivi');
                    if ($url) $h['image'] = $url;
                }
            }

            $highlights[] = $h;
        }

        return $highlights;
    }

    private function validateServiceRequest(Request $request, string $type): void
    {
        $rules = [
            'price' => 'required|numeric|min:0',
        ];

        switch ($type) {
            case 'tour':
                $rules['title'] = 'required|string|max:255';
                $rules['description'] = 'required|string';
                $rules['tour_images.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['days'] = 'required|integer|min:1';
                break;
            case 'car':
                $rules['car_name'] = 'required|string|max:255';
                $rules['vehicle_images.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['transmission'] = 'required|string|max:50';
                $rules['fuel_type'] = 'required|string|max:50';
                $rules['year'] = 'required|integer|min:1900|max:' . (date('Y') + 1);
                break;
            case 'transfer':
                $rules['title'] = 'required|string|max:255';
                break;
            case 'event':
                $rules['title'] = 'required|string|max:255';
                $rules['description'] = 'required|string';
                break;
        }

        $request->validate($rules);
    }
}
