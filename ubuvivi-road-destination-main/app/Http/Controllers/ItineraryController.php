<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Repositories\ItineraryRepository;
use App\Http\Controllers\AppBaseController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Response;

class ItineraryController extends AppBaseController
{
    /** @var  ItineraryRepository */
    private $itineraryRepository;

    public function __construct(ItineraryRepository $itineraryRepo)
    {
        $this->itineraryRepository = $itineraryRepo;
    }

    public function image_available($image_url)
    {
        if (empty($image_url)) return false;
        
        try {
            $client = new \GuzzleHttp\Client(['timeout' => 5, 'connect_timeout' => 5]);
            $response = $client->head($image_url);
            return $response->getStatusCode() === 200;
        } catch (\Throwable $th) {
            // If HEAD fails, try GET as a fallback or assume it might be available if it's a valid URL format
            // but for safety during update, we return false if we can't verify it.
            return false;
        }
    }

    /**
     * Display a listing of the Itinerary.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $itineraries = $this->itineraryRepository->paginate(10);

        return view('itineraries.index')
            ->with('itineraries', $itineraries);
    }

    /**
     * Show the form for creating a new Itinerary.
     *
     * @return Response
     */
    public function create()
    {
        return view('itineraries.create');
    }

    /**
     * Store a newly created Itinerary in storage.
     *
     * @param CreateItineraryRequest $request
     *
     * @return Response
     */
    public function store(CreateItineraryRequest $request)
    {
        $input = $request->all();
        $input["images"] = array();
        $input["image_id"] = array();

        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $file) {
                if (isset($file)) {
                    $file_instance = Cloudinary::upload($file->getRealPath(), array("folder" => "ubuvivi"));
                    if ($file_instance) {
                        array_push($input["images"], $file_instance->getSecurePath());
                        array_push($input['image_id'], $file_instance->getPublicId());
                    }
                }
            }
        }
        $input['price'] = $input['price'] ?? 0;
        $input["images"] = json_encode($input["images"]);
        $input["image_id"] = json_encode($input["image_id"]);
        $input['highlights'] = json_encode(array_values($input["highlight"] ?? array()));
        $input['inclusions'] = json_encode(array_values($input["inclusion"] ?? array()));
        $input['exclusions'] = json_encode(array_values($input["exclusion"] ?? array()));
        $input['days_description'] = json_encode(array_values($input["days_description"]));

        $itinerary = $this->itineraryRepository->create($input);

        Flash::success('Itinerary saved successfully.');

        return redirect(route('itineraries.index'));
    }

    /**
     * Display the specified Itinerary.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itinerary = $this->itineraryRepository->find($id);

        if (empty($itinerary)) {
            Flash::error('Itinerary not found');

            return redirect(route('itineraries.index'));
        }

        return view('itineraries.show')->with('itinerary', $itinerary);
    }

    /**
     * Show the form for editing the specified Itinerary.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itinerary = $this->itineraryRepository->find($id);
        if (empty($itinerary)) {
            Flash::error('Itinerary not found');

            return redirect(route('itineraries.index'));
        }

        $itinerary->images = $itinerary->images ?? array();
        $itinerary->highlights = $itinerary->highlights ?? array();
        $itinerary->inclusions = $itinerary->inclusions ?? array();
        $itinerary->exclusions = $itinerary->exclusions ?? array();
        $itinerary->days_description = $itinerary->days_description ?? array();

        return view('itineraries.edit')->with('itinerary', $itinerary);
    }

    /**
     * Update the specified Itinerary in storage.
     *
     * @param int $id
     * @param UpdateItineraryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItineraryRequest $request)
    {
        $itinerary = $this->itineraryRepository->find($id);

        if (empty($itinerary)) {
            Flash::error('Itinerary not found');

            return redirect(route('itineraries.index'));
        }

        $input = $request->all();

        $input["images"] = array();
        $input["image_id"] = array();

        $itinerary_images = is_array($itinerary->images) ? $itinerary->images : array();
        $itinerary_image_id = is_array($itinerary->image_id) ? $itinerary->image_id : array();

        if (count($itinerary_images) != count($itinerary_image_id)) {
            $itinerary_images = array();
            $itinerary_image_id = array();
        } else {
            foreach ($itinerary_images as $key => $image) {
                if (!$this->image_available($image)) {
                    unset($itinerary_images[$key]);
                    unset($itinerary_image_id[$key]);
                }
            }

            $itinerary_images = array_values($itinerary_images);
            $itinerary_image_id = array_values($itinerary_image_id);
        }

        // insert new images provided by the client
        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $key => $file) {
                if (isset($file)) {
                    $file_instance = Cloudinary::upload($file->getRealPath(), array("folder" => "ubuvivi"));
                    if ($file_instance) {
                        array_push($itinerary_images, $file_instance->getSecurePath());
                        array_push($itinerary_image_id, $file_instance->getPublicId());
                    }
                }
            }
        }

        $input['price'] = $input['price'] ?? 0;
        $input["images"] = json_encode($itinerary_images);
        $input["image_id"] = json_encode($itinerary_image_id);
        $input['highlights'] = json_encode(array_values($input["highlight"] ?? array()));
        $input['inclusions'] = json_encode(array_values($input["inclusion"] ?? array()));
        $input['exclusions'] = json_encode(array_values($input["exclusion"] ?? array()));
        $input['days_description'] = json_encode(array_values($input["days_description"] ?? array()));
        $input["description"] = $input["description"] ?? "";


        $itinerary = $this->itineraryRepository->update($input, $id);

        Flash::success('Itinerary updated successfully.');

        return redirect(route('itineraries.index'));
    }

    /**
     * Remove the specified Itinerary from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itinerary = $this->itineraryRepository->find($id);

        if (empty($itinerary)) {
            Flash::error('Itinerary not found');

            return redirect(route('itineraries.index'));
        }

        $image_id = $itinerary->image_id;

        $this->itineraryRepository->delete($id);

        foreach ($image_id as $image) {
            Cloudinary::destroy($image);
        }

        Flash::success('Itinerary deleted successfully.');

        return redirect(route('itineraries.index'));
    }
}
