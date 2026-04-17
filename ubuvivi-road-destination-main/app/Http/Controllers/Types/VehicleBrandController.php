<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\CreateVehicleBrandRequest;
use App\Http\Requests\Types\UpdateVehicleBrandRequest;
use App\Repositories\Types\VehicleBrandRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VehicleBrandController extends AppBaseController
{
    /** @var  VehicleBrandRepository */
    private $vehicleBrandRepository;

    public function __construct(VehicleBrandRepository $vehicleBrandRepo)
    {
        $this->vehicleBrandRepository = $vehicleBrandRepo;
    }

    /**
     * Display a listing of the VehicleBrand.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vehicleBrands = $this->vehicleBrandRepository->all();

        return view('types.vehicle_brands.index')
            ->with('vehicleBrands', $vehicleBrands);
    }

    /**
     * Show the form for creating a new VehicleBrand.
     *
     * @return Response
     */
    public function create()
    {
        return view('types.vehicle_brands.create');
    }

    /**
     * Store a newly created VehicleBrand in storage.
     *
     * @param CreateVehicleBrandRequest $request
     *
     * @return Response
     */
    public function store(CreateVehicleBrandRequest $request)
    {
        $input = $request->all();

        $vehicleBrand = $this->vehicleBrandRepository->create($input);

        Flash::success('Vehicle Brand saved successfully.');

        return redirect(route('types.vehicleBrands.index'));
    }

    /**
     * Display the specified VehicleBrand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vehicleBrand = $this->vehicleBrandRepository->find($id);

        if (empty($vehicleBrand)) {
            Flash::error('Vehicle Brand not found');

            return redirect(route('types.vehicleBrands.index'));
        }

        return view('types.vehicle_brands.show')->with('vehicleBrand', $vehicleBrand);
    }

    /**
     * Show the form for editing the specified VehicleBrand.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vehicleBrand = $this->vehicleBrandRepository->find($id);

        if (empty($vehicleBrand)) {
            Flash::error('Vehicle Brand not found');

            return redirect(route('types.vehicleBrands.index'));
        }

        return view('types.vehicle_brands.edit')->with('vehicleBrand', $vehicleBrand);
    }

    /**
     * Update the specified VehicleBrand in storage.
     *
     * @param int $id
     * @param UpdateVehicleBrandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVehicleBrandRequest $request)
    {
        $vehicleBrand = $this->vehicleBrandRepository->find($id);

        if (empty($vehicleBrand)) {
            Flash::error('Vehicle Brand not found');

            return redirect(route('types.vehicleBrands.index'));
        }

        $vehicleBrand = $this->vehicleBrandRepository->update($request->all(), $id);

        Flash::success('Vehicle Brand updated successfully.');

        return redirect(route('types.vehicleBrands.index'));
    }

    /**
     * Remove the specified VehicleBrand from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vehicleBrand = $this->vehicleBrandRepository->find($id);

        if (empty($vehicleBrand)) {
            Flash::error('Vehicle Brand not found');

            return redirect(route('types.vehicleBrands.index'));
        }

        $this->vehicleBrandRepository->delete($id);

        Flash::success('Vehicle Brand deleted successfully.');

        return redirect(route('types.vehicleBrands.index'));
    }
}
