<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Repositories\VehicleRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Types\FuelType;
use App\Models\Types\Transmission;
use App\Models\Types\VehicleBrand;
use App\Models\Types\VehicleModel;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Flash;
use Response;

class VehicleController extends AppBaseController
{
    public function image_available($image_url)
    {
        $headers = get_headers($image_url);
        return stripos($headers[0], '200 OK') ? true : false;
    }
    /** @var  VehicleRepository */
    private $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepo)
    {
        $this->vehicleRepository = $vehicleRepo;
    }

    /**
     * Display a listing of the Vehicle.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vehicles = $this->vehicleRepository->allQuery()->with("brand", "fuelType", "model", "transmission")->paginate(10);

        return view('vehicles.index')
            ->with('vehicles', $vehicles);
    }

    /**
     * Show the form for creating a new Vehicle.
     *
     * @return Response
     */
    public function create()
    {
        $brands = VehicleBrand::all();
        $models = VehicleModel::all();
        $fuelTypes = FuelType::all();
        $transmissions = Transmission::all();

        return view('vehicles.create')->with(compact("models", "fuelTypes", "transmissions", "brands"));
    }

    /**
     * Store a newly created Vehicle in storage.
     *
     * @param CreateVehicleRequest $request
     *
     * @return Response
     */
    public function store(CreateVehicleRequest $request)
    {
        $input = $request->all();
        $input["images"] = array();
        $input['image_id'] = array();

        // insert new images provided by the client
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

        $input["plate_number"] = "";
        $input["price"] = 0;
        $input["for_sale"] = 0;
        $input["description"] = $input["description"] ?? "";
        $input["production_year"] = $input["production_year"] ?? "";
        $input["seats"] = $input["seats"] ?? "";

        $vehicle = $this->vehicleRepository->create($input);

        Flash::success('Vehicle saved successfully.');

        return redirect(route('vehicles.index'));
    }

    /**
     * Display the specified Vehicle.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }

        return view('vehicles.show')->with(compact('vehicle'));
    }

    /**
     * Show the form for editing the specified Vehicle.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }

        $brands = VehicleBrand::all();
        $models = VehicleModel::all();
        $fuelTypes = FuelType::all();
        $transmissions = Transmission::all();

        return view('vehicles.edit')->with(compact('vehicle', "models", "fuelTypes", "transmissions", "brands"));
    }

    /**
     * Update the specified Vehicle in storage.
     *
     * @param int $id
     * @param UpdateVehicleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehicleRequest $request)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');
            return redirect(route('vehicles.index'));
        }

        $input = $request->all();
        $input["images"] = array();
        $input['image_id'] = array();
        $vehicle_images = is_array($vehicle->images) ? $vehicle->images : array();
        $vehicle_image_ids = is_array($vehicle->image_id) ? $vehicle->image_id : array();

        if (@count($vehicle_images) != @count($vehicle_image_ids)) {
            $vehicle_images = array();
            $vehicle_image_ids = array();
        } else {
            foreach ($vehicle_image_ids as $key => $image_id) {
                if (!$this->image_available($vehicle_images[$key])) {
                    unset($vehicle_images[$key]);
                    unset($vehicle_image_ids[$key]);
                }
            }
            $input["images"] = array_values($vehicle_images);
            $input['image_id'] = array_values($vehicle_image_ids);
        }

        // insert new images provided by the client
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

        $input["images"] = json_encode($input["images"]);
        $input['image_id'] = json_encode($input['image_id']);
        $input["plate_number"] = "";
        $input["for_sale"] = 0;
        $input["description"] = $input["description"] ?? "";
        $input["production_year"] = $input["production_year"] ?? "";
        $input["seats"] = $input["seats"] ?? "";

        $vehicle = $this->vehicleRepository->update($input, $id);

        Flash::success('Vehicle updated successfully.');

        return redirect()->route('vehicles.index');
    }

    /**
     * Remove the specified Vehicle from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehicle = $this->vehicleRepository->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect(route('vehicles.index'));
        }

        $image_ids = $vehicle->image_id;

        $this->vehicleRepository->delete($id);

        foreach ($image_ids as $image_id) {
            Cloudinary::destroy($image_id);
        }

        Flash::success('Vehicle deleted successfully.');

        return redirect(route('vehicles.index'));
    }
}
