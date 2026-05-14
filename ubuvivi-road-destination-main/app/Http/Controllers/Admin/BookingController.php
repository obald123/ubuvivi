<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourBooking;
use App\Models\CarBooking;
use App\Models\CarTransfer;
use Carbon\Carbon;

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

        $allBookings = $tourBookings
            ->concat($carBookings)
            ->concat($carTransfers)
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
        $model = $this->findBooking($type, $id);
        $status = $request->input('status');

        switch ($status) {
            case 'Completed':
            case 'Active':
            case 'Upcoming':
                $model->approved = true;
                break;
            case 'Cancelled':
                $model->approved = false;
                break;
            case 'Pending':
                $model->approved = null;
                break;
        }

        $model->save();

        return response()->json([
            'success' => true,
            'status' => $this->getBookingStatus($model->fresh()),
        ]);
    }

    private function findBooking($type, $id)
    {
        return match ($type) {
            'TourBooking' => TourBooking::with('tour')->findOrFail($id),
            'CarBooking' => CarBooking::with(['vehicle.brand', 'vehicle.model'])->findOrFail($id),
            'CarTransfer' => CarTransfer::with(['vehicle.brand', 'vehicle.model'])->findOrFail($id),
            default => abort(404),
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
            'message' => $booking->message ?: 'No extra details provided.',
            'price' => $booking->price,
            'location' => $booking->pickup_location ?? $booking->delivery_location ?? null,
            'destination' => $booking->destination ?? null,
            'number_of_days' => $booking->number_of_days ?? null,
            'number_of_people' => $booking->number_of_people ?? null,
        ];
    }

    private function resolveServiceLabel(string $modelType): string
    {
        return match ($modelType) {
            'TourBooking' => 'Tour & Travel',
            'CarBooking' => 'Car Rental',
            'CarTransfer' => 'Transfers',
            default => 'Booking',
        };
    }

    private function resolveTypeLabel($booking, string $modelType): string
    {
        if ($modelType === 'TourBooking') {
            return $booking->tour->title ?? 'Tour Booking';
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
        if (!$model->approved) {
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
