<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\CreateVehicleModelRequest;
use App\Http\Requests\Types\UpdateVehicleModelRequest;
use App\Repositories\Types\VehicleModelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VehicleModelController extends AppBaseController
{
    /** @var  VehicleModelRepository */
    private $vehicleModelRepository;

    public function __construct(VehicleModelRepository $vehicleModelRepo)
    {
        $this->vehicleModelRepository = $vehicleModelRepo;
    }

    /**
     * Display a listing of the VehicleModel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vehicleModels = $this->vehicleModelRepository->all();

        return view('types.vehicle_models.index')
            ->with('vehicleModels', $vehicleModels);
    }

    /**
     * Show the form for creating a new VehicleModel.
     *
     * @return Response
     */
    public function create()
    {
        return view('types.vehicle_models.create');
    }

    /**
     * Store a newly created VehicleModel in storage.
     *
     * @param CreateVehicleModelRequest $request
     *
     * @return Response
     */
    public function store(CreateVehicleModelRequest $request)
    {
        $input = $request->all();

        $vehicleModel = $this->vehicleModelRepository->create($input);

        Flash::success('Vehicle Model saved successfully.');

        return redirect(route('types.vehicleModels.index'));
    }

    /**
     * Display the specified VehicleModel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error('Vehicle Model not found');

            return redirect(route('types.vehicleModels.index'));
        }

        return view('types.vehicle_models.show')->with('vehicleModel', $vehicleModel);
    }

    /**
     * Show the form for editing the specified VehicleModel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error('Vehicle Model not found');

            return redirect(route('types.vehicleModels.index'));
        }

        return view('types.vehicle_models.edit')->with('vehicleModel', $vehicleModel);
    }

    /**
     * Update the specified VehicleModel in storage.
     *
     * @param int $id
     * @param UpdateVehicleModelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehicleModelRequest $request)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error('Vehicle Model not found');

            return redirect(route('types.vehicleModels.index'));
        }

        $vehicleModel = $this->vehicleModelRepository->update($request->all(), $id);

        Flash::success('Vehicle Model updated successfully.');

        return redirect(route('types.vehicleModels.index'));
    }

    /**
     * Remove the specified VehicleModel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehicleModel = $this->vehicleModelRepository->find($id);

        if (empty($vehicleModel)) {
            Flash::error('Vehicle Model not found');

            return redirect(route('types.vehicleModels.index'));
        }

        $this->vehicleModelRepository->delete($id);

        Flash::success('Vehicle Model deleted successfully.');

        return redirect(route('types.vehicleModels.index'));
    }
}
