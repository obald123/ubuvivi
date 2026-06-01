<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourBooking;
use App\Models\CarBooking;
use App\Models\CarTransfer;
use App\Models\FlightBooking;
use App\Models\HotelBooking;
use Carbon\Carbon;

class RequestController extends Controller
{
    public function index()
    {
        $tourBookings = TourBooking::with('tour')->get()
            ->map(fn (TourBooking $booking) => $this->mapRequestRow($booking, 'TourBooking'));

        $carBookings = CarBooking::with(['vehicle.brand', 'vehicle.model'])->get()
            ->map(fn (CarBooking $booking) => $this->mapRequestRow($booking, 'CarBooking'));

        $carTransfers = CarTransfer::with(['vehicle.brand', 'vehicle.model'])->get()
            ->map(fn (CarTransfer $booking) => $this->mapRequestRow($booking, 'CarTransfer'));

        $flightBookings = FlightBooking::all()
            ->map(fn (FlightBooking $booking) => $this->mapRequestRow($booking, 'FlightBooking'));

        $hotelBookings = HotelBooking::with('hotel')->get()
            ->map(fn (HotelBooking $booking) => $this->mapRequestRow($booking, 'HotelBooking'));

        $allRequests = $tourBookings
            ->concat($carBookings)
            ->concat($carTransfers)
            ->concat($flightBookings)
            ->concat($hotelBookings)
            ->sortByDesc('sort_date')
            ->values();

        $allCount = $allRequests->count();
        $pendingCount = $allRequests->where('status', 'Pending')->count();
        $approvedCount = $allRequests->where('status', 'Approved')->count();
        $rejectedCount = $allRequests->where('status', 'Rejected')->count();

        return view('admin.requests.index', compact('allRequests', 'allCount', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function show($type, $id)
    {
        $request = $this->findRequest($type, $id);

        return response()->json($this->mapRequestDetail($request, $type));
    }

    public function updateStatus(Request $request, $type, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Approved,Pending,Rejected',
        ]);

        $model = $this->findRequest($type, $id);

        switch ($validated['status']) {
            case 'Approved':
                $model->approved = true;
                break;
            case 'Rejected':
                $model->approved = false;
                break;
            default:
                $model->approved = null;
                break;
        }

        $model->save();

        return response()->json(['success' => true]);
    }

    private function findRequest(string $type, int $id)
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

    private function mapRequestRow($request, string $modelType): array
    {
        $date = $this->resolveRequestDate($request);
        $status = $this->getApprovalLabel($request);

        return [
            'id' => $request->id,
            'service' => $this->resolveServiceLabel($modelType),
            'type' => $this->resolveTypeLabel($request, $modelType),
            'date' => $date,
            'formatted_date' => $this->formatRequestDate($date),
            'client' => $request->names,
            'email' => $request->email,
            'phone' => $request->phone_number,
            'status' => $status,
            'status_key' => strtolower($status),
            'details' => $request->message,
            'model_type' => $modelType,
            'model_id' => $request->id,
            'sort_date' => $date ?: $request->created_at?->toDateString(),
        ];
    }

    private function mapRequestDetail($request, string $modelType): array
    {
        $date = $this->resolveRequestDate($request);

        $extra = [];
        if ($modelType === 'FlightBooking') {
            $extra['location']       = $request->departure_airport ?? null;
            $extra['destination']    = $request->arrival_airport ?? null;
            $extra['number_of_people'] = $request->number_of_passengers ?? null;
        } elseif ($modelType === 'HotelBooking') {
            $extra['location']       = $request->check_in  ? 'Check-in: '  . $request->check_in->format('d M Y')  : null;
            $extra['destination']    = $request->check_out ? 'Check-out: ' . $request->check_out->format('d M Y') : null;
            $extra['number_of_people'] = $request->number_of_guests ?? null;
        } else {
            $extra['location']       = $request->pickup_location ?? $request->delivery_location ?? null;
            $extra['destination']    = $request->destination ?? null;
            $extra['number_of_days'] = $request->number_of_days ?? null;
            $extra['number_of_people'] = $request->number_of_people ?? null;
        }

        return array_merge([
            'id'      => $request->id,
            'service' => $this->resolveServiceLabel($modelType),
            'type'    => $this->resolveTypeLabel($request, $modelType),
            'status'  => $this->getApprovalLabel($request),
            'date'    => $this->formatRequestDate($date),
            'client'  => $request->names,
            'email'   => $request->email,
            'phone'   => $request->phone_number,
            'message' => $request->message ?: ($request->additional_info ?? 'No extra details provided.'),
            'price'   => $request->price ?? null,
        ], $extra);
    }

    private function resolveServiceLabel(string $modelType): string
    {
        return match ($modelType) {
            'TourBooking'   => 'Tour & Travel',
            'CarBooking'    => 'Car Rental',
            'CarTransfer'   => 'Transfers',
            'FlightBooking' => 'Air Ticketing',
            'HotelBooking'  => 'Hotel Booking',
            default         => 'Request',
        };
    }

    private function resolveTypeLabel($request, string $modelType): string
    {
        if ($modelType === 'TourBooking') {
            return $request->tour->title ?? 'Tour Request';
        }

        if ($modelType === 'CarTransfer') {
            return $request->destination ?: 'Transfer Request';
        }

        if ($modelType === 'FlightBooking') {
            return trim(($request->departure_airport ?? '') . ' → ' . ($request->arrival_airport ?? '')) ?: 'Flight Request';
        }

        if ($modelType === 'HotelBooking') {
            return optional($request->hotel)->name ?? ($request->room_type ?? 'Hotel Request');
        }

        $vehicle = $request->vehicle?->first();
        if (!$vehicle) {
            return 'Vehicle Request';
        }

        $parts = array_filter([
            optional($vehicle->brand)->name,
            optional($vehicle->model)->name,
            $vehicle->production_year ?? null,
        ]);

        return implode(' ', $parts) ?: 'Vehicle Request';
    }

    private function resolveRequestDate($request): ?string
    {
        if ($request instanceof TourBooking) {
            return $request->date;
        }

        if ($request instanceof CarBooking) {
            return $request->delivery_date;
        }

        if ($request instanceof FlightBooking) {
            return $request->departure_date?->toDateString();
        }

        if ($request instanceof HotelBooking) {
            return $request->check_in?->toDateString();
        }

        return $request->pickup_date;
    }

    private function formatRequestDate(?string $date): string
    {
        if (!$date) {
            return 'Date not set';
        }

        try {
            return Carbon::parse($date)->format('d F Y');
        } catch (\Throwable $exception) {
            return $date;
        }
    }

    private function getApprovalLabel($request): string
    {
        if ($request->approved === true) {
            return 'Approved';
        }

        if ($request->approved === false) {
            return 'Rejected';
        }

        return 'Pending';
    }
}
