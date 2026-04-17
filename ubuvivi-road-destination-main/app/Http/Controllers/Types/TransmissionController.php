<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\CreateTransmissionRequest;
use App\Http\Requests\Types\UpdateTransmissionRequest;
use App\Repositories\Types\TransmissionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TransmissionController extends AppBaseController
{
    /** @var  TransmissionRepository */
    private $transmissionRepository;

    public function __construct(TransmissionRepository $transmissionRepo)
    {
        $this->transmissionRepository = $transmissionRepo;
    }

    /**
     * Display a listing of the Transmission.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transmissions = $this->transmissionRepository->all();

        return view('types.transmissions.index')
            ->with('transmissions', $transmissions);
    }

    /**
     * Show the form for creating a new Transmission.
     *
     * @return Response
     */
    public function create()
    {
        return view('types.transmissions.create');
    }

    /**
     * Store a newly created Transmission in storage.
     *
     * @param CreateTransmissionRequest $request
     *
     * @return Response
     */
    public function store(CreateTransmissionRequest $request)
    {
        $input = $request->all();

        $transmission = $this->transmissionRepository->create($input);

        Flash::success('Transmission saved successfully.');

        return redirect(route('types.transmissions.index'));
    }

    /**
     * Display the specified Transmission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transmission = $this->transmissionRepository->find($id);

        if (empty($transmission)) {
            Flash::error('Transmission not found');

            return redirect(route('types.transmissions.index'));
        }

        return view('types.transmissions.show')->with('transmission', $transmission);
    }

    /**
     * Show the form for editing the specified Transmission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transmission = $this->transmissionRepository->find($id);

        if (empty($transmission)) {
            Flash::error('Transmission not found');

            return redirect(route('types.transmissions.index'));
        }

        return view('types.transmissions.edit')->with('transmission', $transmission);
    }

    /**
     * Update the specified Transmission in storage.
     *
     * @param int $id
     * @param UpdateTransmissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransmissionRequest $request)
    {
        $transmission = $this->transmissionRepository->find($id);

        if (empty($transmission)) {
            Flash::error('Transmission not found');

            return redirect(route('types.transmissions.index'));
        }

        $transmission = $this->transmissionRepository->update($request->all(), $id);

        Flash::success('Transmission updated successfully.');

        return redirect(route('types.transmissions.index'));
    }

    /**
     * Remove the specified Transmission from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transmission = $this->transmissionRepository->find($id);

        if (empty($transmission)) {
            Flash::error('Transmission not found');

            return redirect(route('types.transmissions.index'));
        }

        $this->transmissionRepository->delete($id);

        Flash::success('Transmission deleted successfully.');

        return redirect(route('types.transmissions.index'));
    }
}
