<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\CreateFuelTypeRequest;
use App\Http\Requests\Types\UpdateFuelTypeRequest;
use App\Repositories\Types\FuelTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FuelTypeController extends AppBaseController
{
    /** @var  FuelTypeRepository */
    private $fuelTypeRepository;

    public function __construct(FuelTypeRepository $fuelTypeRepo)
    {
        $this->fuelTypeRepository = $fuelTypeRepo;
    }

    /**
     * Display a listing of the FuelType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fuelTypes = $this->fuelTypeRepository->all();

        return view('types.fuel_types.index')
            ->with('fuelTypes', $fuelTypes);
    }

    /**
     * Show the form for creating a new FuelType.
     *
     * @return Response
     */
    public function create()
    {
        return view('types.fuel_types.create');
    }

    /**
     * Store a newly created FuelType in storage.
     *
     * @param CreateFuelTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateFuelTypeRequest $request)
    {
        $input = $request->all();

        $fuelType = $this->fuelTypeRepository->create($input);

        Flash::success('Fuel Type saved successfully.');

        return redirect(route('types.fuelTypes.index'));
    }

    /**
     * Display the specified FuelType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fuelType = $this->fuelTypeRepository->find($id);

        if (empty($fuelType)) {
            Flash::error('Fuel Type not found');

            return redirect(route('types.fuelTypes.index'));
        }

        return view('types.fuel_types.show')->with('fuelType', $fuelType);
    }

    /**
     * Show the form for editing the specified FuelType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fuelType = $this->fuelTypeRepository->find($id);

        if (empty($fuelType)) {
            Flash::error('Fuel Type not found');

            return redirect(route('types.fuelTypes.index'));
        }

        return view('types.fuel_types.edit')->with('fuelType', $fuelType);
    }

    /**
     * Update the specified FuelType in storage.
     *
     * @param int $id
     * @param UpdateFuelTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFuelTypeRequest $request)
    {
        $fuelType = $this->fuelTypeRepository->find($id);

        if (empty($fuelType)) {
            Flash::error('Fuel Type not found');

            return redirect(route('types.fuelTypes.index'));
        }

        $fuelType = $this->fuelTypeRepository->update($request->all(), $id);

        Flash::success('Fuel Type updated successfully.');

        return redirect(route('types.fuelTypes.index'));
    }

    /**
     * Remove the specified FuelType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fuelType = $this->fuelTypeRepository->find($id);

        if (empty($fuelType)) {
            Flash::error('Fuel Type not found');

            return redirect(route('types.fuelTypes.index'));
        }

        $this->fuelTypeRepository->delete($id);

        Flash::success('Fuel Type deleted successfully.');

        return redirect(route('types.fuelTypes.index'));
    }
}
