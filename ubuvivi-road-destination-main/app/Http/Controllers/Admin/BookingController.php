<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingStatusMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\TourBooking;
use App\Models\CarBooking;
use App\Models\CarTransfer;
use App\Models\FlightBooking;
use App\Models\HotelBooking;

class BookingController extends Controller
{
    public function index()
    {
        $tourBookings = TourBooking::with('tour')->get()
            ->map(fn (TourBooking $booking) => $this->mapBookingRow($booking, 'TourBooking'));

        $carBookings = CarBooking::with(['vehicle.brand', 'vehicle.model'])->get()
            ->map(fn (CarBooking $booking) => $this->mapBookingRow($booking, 'CarBooking'));

        $carTransfers = CarTransfer::with(['vehicle.brand', 'vehicle.model'])->get()
            ->map(fn (CarTransfer $booking) => $this->mapBookingRow($booking, 'CarTransfer'));

        $flightBookings = FlightBooking::all()
            ->map(fn (FlightBooking $booking) => $this->mapBookingRow($booking, 'FlightBooking'));

        $hotelBookings = HotelBooking::with('hotel')->get()
            ->map(fn (HotelBooking $booking) => $this->mapBookingRow($booking, 'HotelBooking'));

        $allBookings = $tourBookings
            ->concat($carBookings)
            ->concat($carTransfers)
            ->concat($flightBookings)
            ->concat($hotelBookings)
            ->sortByDesc('sort_date')
            ->values();

        $allCount = $allBookings->count();
        $activeCount = $allBookings->where('status', 'Active')->count();
        $upcomingCount = $allBookings->where('status', 'Upcoming')->count();
        $completedCount = $allBookings->where('status', 'Completed')->count();

        return view('admin.bookings.index', compact('allBookings', 'allCount', 'activeCount', 'upcomingCount', 'completedCount'));
    }

    public function show($type, $id)
    {
        $booking = $this->findBooking($type, $id);

        return response()->json($this->mapBookingDetail($booking, $type));
    }

    public function updateStatus(Request $request, $type, $id)
    {
        $model  = $this->findBooking($type, $id);
        $status = $request->input('status'); // 'Approved' | 'Rejected' | 'Pending'

        $previousApproved = $model->approved;

        switch ($status) {
            case 'Approved':
            case 'Completed':
            case 'Active':
            case 'Upcoming':
                $model->approved = true;
                break;
            case 'Rejected':
            case 'Cancelled':
                $model->approved = false;
                break;
            default:
                $model->approved = null;
                break;
        }

        $model->save();

        // Send status email only when moving from Pending to Approved or Rejected
        if (is_null($previousApproved) && !is_null($model->approved)) {
            try {
                $typeKey   = $this->resolveTokenType($type);
                $tokenLink = null;

                if ($typeKey && method_exists($model, 'access_token') === false && isset($model->access_token)) {
                    $tokenLink = url('/booking/' . $typeKey . '/' . $model->access_token);
                }

                Mail::to($model->email)->send(
                    new BookingStatusMail($model->names, (bool) $model->approved, $tokenLink)
                );
            } catch (\Exception $e) {
                Log::warning('Booking status email failed: ' . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'status'  => $this->getBookingStatus($model->fresh()),
        ]);
    }

    private function resolveTokenType(string $modelType): ?string
    {
        return match ($modelType) {
            'HotelBooking'  => 'hotel',
            'FlightBooking' => 'flight',
            'CarBooking'    => 'car',
            'TourBooking'   => 'tour',
            'CarTransfer'   => 'transfer',
            default         => null,
        };
    }

    private function findBooking($type, $id)
    {
        return match ($type) {
            'TourBooking'   => TourBooking::with('tour')->findOrFail($id),
            'CarBooking'    => CarBooking::with(['vehicle.brand', 'vehicle.model'])->findOrFail($id),
            'CarTransfer'   => CarTransfer::with(['vehicle.brand', 'vehicle.model'])->findOrFail($id),
            'FlightBooking' => FlightBooking::findOrFail($id),
            'HotelBooking'  => HotelBooking::with('hotel')->findOrFail($id),
            default         => abort(404),
        };
    }

    private function mapBookingRow($booking, string $modelType): array
    {
        $date = $this->resolveBookingDate($booking);
        $status = $this->getBookingStatus($booking);

        return [
            'id' => $booking->id,
            'service' => $this->resolveServiceLabel($modelType),
            'type' => $this->resolveTypeLabel($booking, $modelType),
            'date' => $date,
            'formatted_date' => $this->formatBookingDate($date),
            'client' => $booking->names,
            'email' => $booking->email,
            'phone' => $booking->phone_number,
            'status' => $status,
            'status_key' => strtolower($status),
            'details' => $booking->message,
            'model_type' => $modelType,
            'model_id' => $booking->id,
            'sort_date' => $date ?: $booking->created_at?->toDateString(),
        ];
    }

    private function mapBookingDetail($booking, string $modelType): array
    {
        $date = $this->resolveBookingDate($booking);

        return [
            'id' => $booking->id,
            'service' => $this->resolveServiceLabel($modelType),
            'type' => $this->resolveTypeLabel($booking, $modelType),
            'status' => $this->getBookingStatus($booking),
            'date' => $this->formatBookingDate($date),
            'client' => $booking->names,
            'email' => $booking->email,
            'phone' => $booking->phone_number,
            'message' => $booking->message ?: ($booking->additional_info ?? 'No extra details provided.'),
            'price'   => $booking->price ?? null,
        ] + ($modelType === 'FlightBooking' ? [
            'location'       => $booking->departure_airport ?? null,
            'destination'    => $booking->arrival_airport ?? null,
            'number_of_people' => $booking->number_of_passengers ?? null,
        ] : ($modelType === 'HotelBooking' ? [
            'location'       => $booking->check_in  ? 'Check-in: '  . $booking->check_in->format('d M Y')  : null,
            'destination'    => $booking->check_out ? 'Check-out: ' . $booking->check_out->format('d M Y') : null,
            'number_of_people' => $booking->number_of_guests ?? null,
        ] : [
            'location'       => $booking->pickup_location ?? $booking->delivery_location ?? null,
            'destination'    => $booking->destination ?? null,
            'number_of_days' => $booking->number_of_days ?? null,
            'number_of_people' => $booking->number_of_people ?? null,
        ]));
    }

    private function resolveServiceLabel(string $modelType): string
    {
        return match ($modelType) {
            'TourBooking'   => 'Tour & Travel',
            'CarBooking'    => 'Car Rental',
            'CarTransfer'   => 'Transfers',
            'FlightBooking' => 'Air Ticketing',
            'HotelBooking'  => 'Hotel Booking',
            default         => 'Booking',
        };
    }

    private function resolveTypeLabel($booking, string $modelType): string
    {
        if ($modelType === 'TourBooking') {
            return $booking->tour->title ?? 'Tour Booking';
        }

        if ($modelType === 'FlightBooking') {
            return trim(($booking->departure_airport ?? '') . ' → ' . ($booking->arrival_airport ?? '')) ?: 'Flight Booking';
        }

        if ($modelType === 'HotelBooking') {
            return optional($booking->hotel)->name ?? ($booking->room_type ?? 'Hotel Booking');
        }

        $vehicle = $booking->vehicle?->first();
        if (!$vehicle) {
            return $modelType === 'CarTransfer' ? 'Transfer Booking' : 'Vehicle Booking';
        }

        $parts = array_filter([
            optional($vehicle->brand)->name,
            optional($vehicle->model)->name,
            $vehicle->production_year ?? null,
        ]);

        return implode(' ', $parts) ?: 'Vehicle Booking';
    }

    private function resolveBookingDate($booking): ?string
    {
        if ($booking instanceof TourBooking) {
            return $booking->date;
        }

        if ($booking instanceof CarBooking) {
            return $booking->delivery_date;
        }

        if ($booking instanceof FlightBooking) {
            return $booking->departure_date?->toDateString();
        }

        if ($booking instanceof HotelBooking) {
            return $booking->check_in?->toDateString();
        }

        return $booking->pickup_date;
    }

    private function formatBookingDate(?string $date): string
    {
        if (!$date) {
            return 'Date not set';
        }

        try {
            return Carbon::parse($date)->format('d F Y');
        } catch (\Throwable $e) {
            return $date;
        }
    }

    private function getBookingStatus($model)
    {
        if ($model->approved === false) {
            return 'Rejected';
        }

        if (is_null($model->approved)) {
            return 'Pending';
        }

        $bookingDate = $this->resolveBookingDate($model);
        if (!$bookingDate) {
            return 'Active';
        }

        try {
            $date = Carbon::parse($bookingDate);
            $today = Carbon::today();

            if ($date->lt($today)) {
                return 'Completed';
            }

            if ($date->isToday()) {
                return 'Active';
            }

            return 'Upcoming';
        } catch (\Throwable $e) {
            return 'Active';
        }
    }
}
