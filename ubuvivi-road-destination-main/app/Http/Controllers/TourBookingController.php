<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTourBookingRequest;
use App\Http\Requests\UpdateTourBookingRequest;
use App\Repositories\TourBookingRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\TourBooking;
use Illuminate\Http\Request;
use Flash;
use Response;

class TourBookingController extends AppBaseController
{
    /** @var  TourBookingRepository */
    private $tourBookingRepository;

    public function __construct(TourBookingRepository $tourBookingRepo)
    {
        $this->tourBookingRepository = $tourBookingRepo;
    }

    /**
     * Display a listing of the TourBooking.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tourBookings = $this->tourBookingRepository->paginate(10);

        return view('tour_bookings.index')
            ->with('tourBookings', $tourBookings);
    }

    /**
     * Show the form for creating a new TourBooking.
     *
     * @return Response
     */
    public function create()
    {
        return view('tour_bookings.create');
    }

    /**
     * Store a newly created TourBooking in storage.
     *
     * @param CreateTourBookingRequest $request
     *
     * @return Response
     */
    public function store(CreateTourBookingRequest $request)
    {
        $input = $request->all();

        $tourBooking = $this->tourBookingRepository->create($input);

        Flash::success('Tour Booking saved successfully.');

        return redirect(route('tourBookings.index'));
    }

    /**
     * Display the specified TourBooking.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tourBooking = $this->tourBookingRepository->find($id);

        if (empty($tourBooking)) {
            Flash::error('Tour Booking not found');

            return redirect(route('tourBookings.index'));
        }
        $itinerary = $tourBooking->tour;
        $itinerary->images = $itinerary->images ? $itinerary->images : array();
        $itinerary->highlights = $itinerary->highlights ? $itinerary->highlights : array();
        $itinerary->inclusions = $itinerary->inclusions ? $itinerary->inclusions : array();
        $itinerary->exclusions = $itinerary->exclusions ? $itinerary->exclusions : array();
        $itinerary->days_description = $itinerary->days_description ? $itinerary->days_description : array();

        return view('tour_bookings.show', compact("tourBooking", "itinerary"));
    }

    /**
     * Show the form for editing the specified TourBooking.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tourBooking = $this->tourBookingRepository->find($id);

        if (empty($tourBooking)) {
            Flash::error('Tour Booking not found');

            return redirect(route('tourBookings.index'));
        }


        return view('tour_bookings.edit', compact("tourBooking"));
    }

    /**
     * Update the specified TourBooking in storage.
     *
     * @param int $id
     * @param UpdateTourBookingRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            "names" => "required|string|max:255",
            "email" => "required|string|max:255",
            "phone_number" => "required|string|max:13",
            "number_of_people" => "nullable",
            "date" => "nullable",
        ]);

        $tourBooking = $this->tourBookingRepository->find($id);

        if (empty($tourBooking)) {
            Flash::error('Tour Booking not found');

            return redirect(route('tourBookings.index'));
        }

        $request["number_of_people"] = $request["number_of_people"] ?? 1;
        $request["date"] = $request["date"] ?? "";
        $request["message"] = $request["message"] ?? "";
        $request["price"] = $request["price"] ?? "";

        $tourBooking = $tourBooking->update($request->all(), [$id]);

        Flash::success('Tour Booking is successfully received.');

        return redirect(route('tourBookings.index'));
    }

    /**
     * Remove the specified TourBooking from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tourBooking = $this->tourBookingRepository->find($id);

        if (empty($tourBooking)) {
            Flash::error('Tour Booking not found');

            return redirect(route('tourBookings.index'));
        }

        $this->tourBookingRepository->delete($id);

        Flash::success('Tour Booking deleted successfully.');

        return redirect(route('tourBookings.index'));
    }
}
