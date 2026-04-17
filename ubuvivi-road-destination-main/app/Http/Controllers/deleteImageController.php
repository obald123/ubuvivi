<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\Vehicle;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class deleteImageController extends Controller
{
    public function image_available($image_url)
    {
        $headers = get_headers($image_url);
        return stripos($headers[0], '200 OK') ? true : false;
    }

    public function removeImage($images, $deletedImage)
    {
        if ($images) {
            if (($key = array_search($deletedImage, $images)) !== false) {
                unset($images[$key]);
            }
        }

        return array_values($images) ?? [];
    }

    public function vehicle(Request $request)
    {
        $vehicle = Vehicle::find($request->id);

        if (empty($vehicle)) {
            return response()->json("Unable to find a vehicle associated to this image", 404);
        }

        if (isset($request->image)) {
            $image_id = $vehicle->image_id;
            $images = $vehicle->images;
            if ($this->image_available($request->image)) {
                try {
                    foreach ($images as $key => $image) {
                        if ($image == $request->image) {
                            Cloudinary::destroy($image_id[$key]);
                            $vehicle->images = $this->removeImage($vehicle->images, $image);
                            $vehicle->image_id = $this->removeImage($vehicle->image_id, $image_id[$key]);
                            break;
                        }
                    }

                    $vehicle->save();
                } catch (\Throwable $th) {
                    dd($th);
                    return response()->json("Failed to delete images.", 404);
                }
                return response()->json("Image deleted.", 200);
            } else {
                foreach ($images as $key => $image) {
                    if ($image == $request->image) {
                        $image_id = $this->removeImage($image_id, $image_id[$key]);
                        $vehicle->images = $this->removeImage($vehicle->images, $image);
                        break;
                    }
                }
                $vehicle->save();

                return response()->json("success", 200);
            }
        } else {
            return response()->json("No image to delete.", 404);
        }
    }

    public function itinerary(Request $request)
    {
        $itinerary = Itinerary::find($request->id);

        if (empty($itinerary)) {
            return response()->json("Unable to find a itinerary associated to this image", 404);
        }

        if (isset($request->image)) {
            $image_id = $itinerary->image_id;
            $images = $itinerary->images;

            if ($this->image_available($request->image)) {

                try {
                    foreach ($images as $key => $image) {
                        if ($image == $request->image) {
                            Cloudinary::destroy($image_id[$key]);
                            $itinerary->images = $this->removeImage($itinerary->images, $image);
                            $itinerary->image_id = $this->removeImage($itinerary->image_id, $image_id[$key]);
                            break;
                        }
                    }

                    $itinerary->save();
                } catch (\Throwable $th) {

                    return response()->json($th, 404);
                }
                return response()->json("Image deleted.", 200);
            } else {

                foreach ($images as $key => $image) {
                    if ($image == $request->image) {
                        $itinerary->images = $this->removeImage($itinerary->images, $image);
                        $itinerary->image_id = $this->removeImage($itinerary->image_id, $image_id[$key]);
                        break;
                    }
                }

                $itinerary->save();
                return response()->json('success', 200);
            }
        } else {
            return response()->json("No image to delete.", 404);
        }
    }
}
