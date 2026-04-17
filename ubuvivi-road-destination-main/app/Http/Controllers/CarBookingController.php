<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarBookingRequest;
use App\Http\Requests\UpdateCarBookingRequest;
use App\Repositories\CarBookingRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CarBookingController extends AppBaseController
{
    /** @var  CarBookingRepository */
    private $carBookingRepository;

    public function __construct(CarBookingRepository $carBookingRepo)
    {
        $this->carBookingRepository = $carBookingRepo;
    }

    /**
     * Display a listing of the CarBooking.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $carBookings = $this->carBookingRepository->paginate(10);
        return view('car_bookings.index')
            ->with('carBookings', $carBookings);
    }

    /**
     * Show the form for creating a new CarBooking.
     *
     * @return Response
     */
    public function create()
    {
        return view('car_bookings.create');
    }

    /**
     * Store a newly created CarBooking in storage.
     *
     * @param CreateCarBookingRequest $request
     *
     * @return Response
     */
    public function store(CreateCarBookingRequest $request)
    {
        $input = $request->all();

        $carBooking = $this->carBookingRepository->create($input);

        Flash::success('Car Booking saved successfully.');

        return redirect(route('carBookings.index'));
    }

    /**
     * Display the specified CarBooking.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $carBooking = $this->carBookingRepository->find($id);

        if (empty($carBooking)) {
            Flash::error('Car Booking not found');

            return redirect(route('carBookings.index'));
        }

        $vehicle = $carBooking->vehicle;
        $vehicle = $vehicle->first() ?? null;

        return view('car_bookings.show', compact("carBooking", "vehicle"));
    }

    /**
     * Show the form for editing the specified CarBooking.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $carBooking = $this->carBookingRepository->find($id);

        if (empty($carBooking)) {
            Flash::error('Car Booking not found');

            return redirect(route('carBookings.index'));
        }

        $carBooking->vehicle = $carBooking->vehicle;

        if (!empty($carBooking->vehicle)) {
            $carBooking->vehicle = $carBooking->vehicle->first();
        }

        return view('car_bookings.edit')->with('carBooking', $carBooking);
    }

    /**
     * Update the specified CarBooking in storage.
     *
     * @param int $id
     * @param UpdateCarBookingRequest $request
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

        $carBooking = $this->carBookingRepository->find($id);

        if (empty($carBooking)) {
            Flash::error('Car Booking not found');

            return redirect(route('carBookings.index'));
        }

        $request["message"] = $request["message"] ?? "";
        $request["delivery_date"] = $request["delivery_date"] ?? "";
        $request["delivery_time"] = $request["delivery_time"] ?? "";
        $request["number_of_days"] = $request["number_of_days"] ?? 1;
        $request["delivery_location"] = $request["delivery_location"] ?? "";
        $request["price"] = $request["price"] ?? "";

        $carBooking = $this->carBookingRepository->update($request->all(), $id);

        Flash::success('Car Booking is successfully received.');

        return redirect(route('carBookings.index'));
    }

    /**
     * Remove the specified CarBooking from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $carBooking = $this->carBookingRepository->find($id);

        if (empty($carBooking)) {
            Flash::error('Car Booking not found');

            return redirect(route('carBookings.index'));
        }

        $this->carBookingRepository->delete($id);

        Flash::success('Car Booking deleted successfully.');

        return redirect(route('carBookings.index'));
    }
}
