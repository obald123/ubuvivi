<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarTransferRequest;
use App\Http\Requests\UpdateCarTransferRequest;
use App\Repositories\CarTransferRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CarTransferController extends AppBaseController
{
    /** @var  CarTransferRepository */
    private $carTransferRepository;

    public function __construct(CarTransferRepository $carTransferRepo)
    {
        $this->carTransferRepository = $carTransferRepo;
    }

    /**
     * Display a listing of the CarTransfer.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $carTransfers = $this->carTransferRepository->paginate(10);

        return view('car_transfers.index')
            ->with('carTransfers', $carTransfers);
    }

    /**
     * Show the form for creating a new CarTransfer.
     *
     * @return Response
     */
    public function create()
    {
        return view('car_transfers.create');
    }

    /**
     * Store a newly created CarTransfer in storage.
     *
     * @param CreateCarTransferRequest $request
     *
     * @return Response
     */
    public function store(CreateCarTransferRequest $request)
    {
        $input = $request->all();

        $carTransfer = $this->carTransferRepository->create($input);

        Flash::success('Car Transfer saved successfully.');

        return redirect(route('carTransfers.index'));
    }

    /**
     * Display the specified CarTransfer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $carTransfer = $this->carTransferRepository->find($id);

        if (empty($carTransfer)) {
            Flash::error('Car Transfer not found');

            return redirect(route('carTransfers.index'));
        }

        $vehicle = $carTransfer->vehicle;
        $vehicle = $vehicle->first() ?? null;

        return view('car_transfers.show', compact("carTransfer", "vehicle"));
    }

    /**
     * Show the form for editing the specified CarTransfer.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $carTransfer = $this->carTransferRepository->find($id);

        if (empty($carTransfer)) {
            Flash::error('Car Transfer not found');

            return redirect(route('carTransfers.index'));
        }

        $carTransfer->vehicle = $carTransfer->vehicle;

        if (!empty($carTransfer->vehicle)) {
            $carTransfer->vehicle = $carTransfer->vehicle->first();
        }

        return view('car_transfers.edit')->with('carTransfer', $carTransfer);
    }

    /**
     * Update the specified CarTransfer in storage.
     *
     * @param int $id
     * @param UpdateCarTransferRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            "names" => "required|string|max:255",
            "email" => "required|string|max:255",
            "phone_number" => "required|string",
            "number_of_days" => "nullable",
            "location" => "nullable",
            "date" => "nullable",
            "time" => "nullable",
            "message" => "nullable"
        ]);


        $carTransfer = $this->carTransferRepository->find($id);

        if (empty($carTransfer)) {
            Flash::error('Car Transfer not found');

            return redirect(route('carTransfers.index'));
        }

        $request["message"] = $request["message"] ?? "";
        $request["destination"] = $request["destination"] ?? "";
        $request["pickup_date"] = $request["pickup_date"] ?? "";
        $request["pickup_time"] = $request["pickup_time"] ?? "";
        $request["number_of_days"] = $request["number_of_days"] ?? 1;
        $request["pickup_location"] = $request["pickup_location"] ?? "";
        $request["price"] = $request["price"] ?? "";

        $carTransfer = $this->carTransferRepository->update($request->all(), $id);

        Flash::success('Car Transfer is successfully received.');

        return redirect(route('carTransfers.index'));
    }

    /**
     * Remove the specified CarTransfer from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $carTransfer = $this->carTransferRepository->find($id);

        if (empty($carTransfer)) {
            Flash::error('Car Transfer not found');

            return redirect(route('carTransfers.index'));
        }

        $this->carTransferRepository->delete($id);

        Flash::success('Car Transfer deleted successfully.');

        return redirect(route('carTransfers.index'));
    }
}
