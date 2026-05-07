<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourBooking;
use App\Models\CarBooking;
use App\Models\CarTransfer;
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

        $allRequests = $tourBookings
            ->concat($carBookings)
            ->concat($carTransfers)
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
            'TourBooking' => TourBooking::with('tour')->findOrFail($id),
            'CarBooking' => CarBooking::with(['vehicle.brand', 'vehicle.model'])->findOrFail($id),
            'CarTransfer' => CarTransfer::with(['vehicle.brand', 'vehicle.model'])->findOrFail($id),
            default => abort(404),
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

        return [
            'id' => $request->id,
            'service' => $this->resolveServiceLabel($modelType),
            'type' => $this->resolveTypeLabel($request, $modelType),
            'status' => $this->getApprovalLabel($request),
            'date' => $this->formatRequestDate($date),
            'client' => $request->names,
            'email' => $request->email,
            'phone' => $request->phone_number,
            'message' => $request->message ?: 'No extra details provided.',
            'price' => $request->price,
            'location' => $request->pickup_location ?? $request->delivery_location ?? null,
            'destination' => $request->destination ?? null,
            'number_of_days' => $request->number_of_days ?? null,
            'number_of_people' => $request->number_of_people ?? null,
        ];
    }

    private function resolveServiceLabel(string $modelType): string
    {
        return match ($modelType) {
            'TourBooking' => 'Tour & Travel',
            'CarBooking' => 'Car Rental',
            'CarTransfer' => 'Transfers',
            default => 'Request',
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
