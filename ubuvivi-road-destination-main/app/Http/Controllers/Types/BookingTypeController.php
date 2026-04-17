<?php

namespace App\Http\Controllers\Types;

use App\Http\Requests\Types\CreateBookingTypeRequest;
use App\Http\Requests\Types\UpdateBookingTypeRequest;
use App\Repositories\Types\BookingTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BookingTypeController extends AppBaseController
{
    /** @var  BookingTypeRepository */
    private $bookingTypeRepository;

    public function __construct(BookingTypeRepository $bookingTypeRepo)
    {
        $this->bookingTypeRepository = $bookingTypeRepo;
    }

    /**
     * Display a listing of the BookingType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $bookingTypes = $this->bookingTypeRepository->all();

        return view('types.booking_types.index')
            ->with('bookingTypes', $bookingTypes);
    }

    /**
     * Show the form for creating a new BookingType.
     *
     * @return Response
     */
    public function create()
    {
        return view('types.booking_types.create');
    }

    /**
     * Store a newly created BookingType in storage.
     *
     * @param CreateBookingTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateBookingTypeRequest $request)
    {
        $input = $request->all();

        $bookingType = $this->bookingTypeRepository->create($input);

        Flash::success('Booking Type saved successfully.');

        return redirect(route('types.bookingTypes.index'));
    }

    /**
     * Display the specified BookingType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bookingType = $this->bookingTypeRepository->find($id);

        if (empty($bookingType)) {
            Flash::error('Booking Type not found');

            return redirect(route('types.bookingTypes.index'));
        }

        return view('types.booking_types.show')->with('bookingType', $bookingType);
    }

    /**
     * Show the form for editing the specified BookingType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bookingType = $this->bookingTypeRepository->find($id);

        if (empty($bookingType)) {
            Flash::error('Booking Type not found');

            return redirect(route('types.bookingTypes.index'));
        }

        return view('types.booking_types.edit')->with('bookingType', $bookingType);
    }

    /**
     * Update the specified BookingType in storage.
     *
     * @param int $id
     * @param UpdateBookingTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookingTypeRequest $request)
    {
        $bookingType = $this->bookingTypeRepository->find($id);

        if (empty($bookingType)) {
            Flash::error('Booking Type not found');

            return redirect(route('types.bookingTypes.index'));
        }

        $bookingType = $this->bookingTypeRepository->update($request->all(), $id);

        Flash::success('Booking Type updated successfully.');

        return redirect(route('types.bookingTypes.index'));
    }

    /**
     * Remove the specified BookingType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bookingType = $this->bookingTypeRepository->find($id);

        if (empty($bookingType)) {
            Flash::error('Booking Type not found');

            return redirect(route('types.bookingTypes.index'));
        }

        $this->bookingTypeRepository->delete($id);

        Flash::success('Booking Type deleted successfully.');

        return redirect(route('types.bookingTypes.index'));
    }
}
