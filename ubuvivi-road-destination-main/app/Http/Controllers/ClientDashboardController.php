<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Vehicle;

class ClientDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'client']);
    }

    public function index()
    {
        $user  = Auth::user();
        $email = $user->email;
        $today = now()->toDateString();

        // Tour bookings
        $tours = DB::table('tour_bookings')
            ->leftJoin('itinerary', 'tour_bookings.itinerary_id', '=', 'itinerary.id')
            ->select('tour_bookings.id', 'itinerary.title as name', 'tour_bookings.date',
                     'tour_bookings.price', 'tour_bookings.approved')
            ->where('tour_bookings.email', $email)
            ->get()
            ->map(fn($b) => (object)[
                'id'       => $b->id,
                'service'  => 'Tour & Travel',
                'name'     => $b->name ?? 'Tour',
                'date'     => $b->date,
                'price'    => $b->price,
                'approved' => $b->approved,
                'type'     => 'tour',
            ]);

        // Car rental bookings — batch vehicle lookup to avoid N+1
        $carBookingRows = DB::table('car_bookings')
            ->select('id', 'delivery_date as date', 'price', 'approved')
            ->where('email', $email)
            ->get();

        $carBookingIds = $carBookingRows->pluck('id')->toArray();

        $vehiclesByBooking = DB::table('vehicle_bookings')
            ->join('vehicles', 'vehicle_bookings.vehicle_id', '=', 'vehicles.id')
            ->leftJoin('vehicle_brands', 'vehicles.brand_id', '=', 'vehicle_brands.id')
            ->leftJoin('vehicle_models', 'vehicles.model_id', '=', 'vehicle_models.id')
            ->whereIn('vehicle_bookings.car_booking_id', $carBookingIds)
            ->select('vehicle_bookings.car_booking_id',
                     'vehicle_brands.name as brand',
                     'vehicle_models.name as model',
                     'vehicles.production_year as year')
            ->get()
            ->keyBy('car_booking_id');

        $cars = $carBookingRows->map(function ($b) use ($vehiclesByBooking) {
            $vehicle = $vehiclesByBooking->get($b->id);
            $name = $vehicle
                ? trim(($vehicle->brand ?? '') . ' ' . ($vehicle->model ?? '') . ' ' . ($vehicle->year ?? ''))
                : '';

            return (object)[
                'id'       => $b->id,
                'service'  => 'Car Rental',
                'name'     => $name ?: 'Car Rental',
                'date'     => $b->date,
                'price'    => $b->price,
                'approved' => $b->approved,
                'type'     => 'car_rental',
            ];
        });

        // Transfer bookings
        $transfers = DB::table('car_transfers')
            ->select('id', 'pickup_date as date', 'price', 'approved', 'destination')
            ->where('email', $email)
            ->get()
            ->map(fn($b) => (object)[
                'id'       => $b->id,
                'service'  => 'Transfers',
                'name'     => $b->destination ?: 'Transfer',
                'date'     => $b->date,
                'price'    => $b->price,
                'approved' => $b->approved,
                'type'     => 'transfer',
            ]);

        $allBookings = $tours->concat($cars)->concat($transfers)->sortByDesc('date');

        $upcoming       = $allBookings->filter(fn($b) => $b->date >= $today && $b->approved);
        $completed      = $allBookings->filter(fn($b) => $b->date < $today);
        $pending        = $allBookings->filter(fn($b) => is_null($b->approved));
        $active         = $allBookings->filter(fn($b) => $b->date === $today && $b->approved);
        $recentBookings = $allBookings->take(5);
        $bookingDates   = $allBookings->pluck('date')->unique()->values()->toJson();

        return view('client.dashboard', compact(
            'user', 'allBookings', 'upcoming', 'completed', 'pending',
            'active', 'recentBookings', 'bookingDates'
        ));
    }

    /* ── My Bookings ── */
    public function bookings()
    {
        $user  = Auth::user();
        $email = $user->email;
        $today = now()->toDateString();

        $tours = DB::table('tour_bookings')
            ->leftJoin('itinerary', 'tour_bookings.itinerary_id', '=', 'itinerary.id')
            ->select('tour_bookings.id', 'itinerary.title as name', 'tour_bookings.date',
                     'tour_bookings.price', 'tour_bookings.approved')
            ->where('tour_bookings.email', $email)->get()
            ->map(fn($b) => (object)['id' => $b->id, 'service' => 'Tour & Travel',
                'name' => $b->name ?? 'Tour', 'date' => $b->date,
                'price' => $b->price, 'approved' => $b->approved]);

        $carRows = DB::table('car_bookings')
            ->select('id', 'delivery_date as date', 'price', 'approved')
            ->where('email', $email)->get();

        $carIds = $carRows->pluck('id')->toArray();

        $vByBooking = DB::table('vehicle_bookings')
            ->join('vehicles', 'vehicle_bookings.vehicle_id', '=', 'vehicles.id')
            ->leftJoin('vehicle_brands', 'vehicles.brand_id', '=', 'vehicle_brands.id')
            ->leftJoin('vehicle_models', 'vehicles.model_id', '=', 'vehicle_models.id')
            ->whereIn('vehicle_bookings.car_booking_id', $carIds)
            ->select('vehicle_bookings.car_booking_id',
                     'vehicle_brands.name as brand',
                     'vehicle_models.name as model',
                     'vehicles.production_year as year')
            ->get()->keyBy('car_booking_id');

        $cars = $carRows->map(function ($b) use ($vByBooking) {
            $v    = $vByBooking->get($b->id);
            $name = $v ? trim(($v->brand ?? '') . ' ' . ($v->model ?? '') . ' ' . ($v->year ?? '')) : '';
            return (object)['id' => $b->id, 'service' => 'Car Rental',
                'name' => $name ?: 'Car Rental', 'date' => $b->date,
                'price' => $b->price, 'approved' => $b->approved];
        });

        $transfers = DB::table('car_transfers')
            ->select('id', 'pickup_date as date', 'price', 'approved', 'destination')
            ->where('email', $email)->get()
            ->map(fn($b) => (object)['id' => $b->id, 'service' => 'Transfers',
                'name' => $b->destination ?: 'Transfer', 'date' => $b->date,
                'price' => $b->price, 'approved' => $b->approved]);

        $all       = $tours->concat($cars)->concat($transfers)->sortByDesc('date')->values();
        $upcoming  = $all->filter(fn($b) => $b->date >= $today && $b->approved);
        $completed = $all->filter(fn($b) => $b->date < $today);
        $pending   = $all->filter(fn($b) => is_null($b->approved) && $b->date >= $today);
        $rejected  = $all->filter(fn($b) => !is_null($b->approved) && !$b->approved);
        $active    = $all->filter(fn($b) => $b->date === $today && $b->approved);

        return view('client.bookings', compact('all', 'upcoming', 'completed', 'pending', 'rejected', 'active'));
    }

    /* ── Notifications ── */
    public function notifications()
    {
        $user  = Auth::user();
        $email = $user->email;
        $today = now()->toDateString();

        $notifications = collect();

        // Tour bookings
        $tours = DB::table('tour_bookings')
            ->leftJoin('itinerary', 'tour_bookings.itinerary_id', '=', 'itinerary.id')
            ->select('tour_bookings.id', 'itinerary.title as name', 'tour_bookings.date',
                     'tour_bookings.approved', 'tour_bookings.created_at')
            ->where('tour_bookings.email', $email)
            ->orderByDesc('tour_bookings.created_at')
            ->get();

        foreach ($tours as $b) {
            $label = $b->name ?? 'Tour';
            $notifications->push($this->bookingNotification('Tour & Travel', $label, $b->date, $b->approved, $b->created_at, $today));
        }

        // Car bookings
        $cars = DB::table('car_bookings')
            ->select('id', 'delivery_date as date', 'approved', 'created_at')
            ->where('email', $email)
            ->orderByDesc('created_at')
            ->get();

        foreach ($cars as $b) {
            $notifications->push($this->bookingNotification('Car Rental', 'Car Rental', $b->date, $b->approved, $b->created_at, $today));
        }

        // Transfers
        $transfers = DB::table('car_transfers')
            ->select('id', 'pickup_date as date', 'approved', 'created_at', 'destination')
            ->where('email', $email)
            ->orderByDesc('created_at')
            ->get();

        foreach ($transfers as $b) {
            $notifications->push($this->bookingNotification('Transfer', $b->destination ?: 'Transfer', $b->date, $b->approved, $b->created_at, $today));
        }

        $notifications = $notifications->sortByDesc('created_at')->values();

        return view('client.notifications', compact('notifications'));
    }

    private function bookingNotification(string $service, string $label, $date, $approved, $createdAt, string $today): array
    {
        $created = \Carbon\Carbon::parse($createdAt);

        if ($approved === true || $approved == 1) {
            if ($date < $today) {
                $title   = "{$service} Booking Completed";
                $desc    = "Your booking for \"{$label}\" has been completed.";
                $icon    = 'ni-green'; $fa = 'fa-check-circle';
                $tag     = 'history';
            } elseif ($date === $today) {
                $title   = "{$service} Booking Active Today";
                $desc    = "Your booking for \"{$label}\" is active today.";
                $icon    = 'ni-blue'; $fa = 'fa-calendar-check';
                $tag     = 'today';
            } else {
                $title   = "{$service} Booking Confirmed";
                $desc    = "Your booking for \"{$label}\" on {$date} has been confirmed.";
                $icon    = 'ni-green'; $fa = 'fa-check-circle';
                $tag     = 'all';
            }
            $unread = false;
        } elseif ($approved === false || $approved == 0) {
            $title   = "{$service} Booking Not Approved";
            $desc    = "Your booking for \"{$label}\" was not approved.";
            $icon    = 'ni-red'; $fa = 'fa-times-circle';
            $tag     = 'history';
            $unread  = false;
        } else {
            $title   = "{$service} Booking Pending";
            $desc    = "Your booking for \"{$label}\" is awaiting approval.";
            $icon    = 'ni-yellow'; $fa = 'fa-clock';
            $tag     = $created->isToday() ? 'today' : 'all';
            $unread  = $created->isToday();
        }

        return [
            'icon'       => $icon,
            'fa'         => $fa,
            'title'      => $title,
            'desc'       => $desc,
            'unread'     => $unread,
            'tag'        => $tag,
            'created_at' => $created,
            'ago'        => $created->diffForHumans(),
        ];
    }

    /* ── New Booking form ── */
    public function newBooking()
    {
        $tours    = DB::table('itinerary')->select('id', 'title')->get();
        $vehicles = Vehicle::with('brand', 'model')->latest()->get()
            ->map(fn($v) => (object)[
                'id'   => $v->id,
                'name' => trim(optional($v->brand)->name . ' ' . optional($v->model)->name . ' ' . $v->production_year),
            ]);
        return view('client.new-booking', compact('tours', 'vehicles'));
    }

    /* ── AJAX: type options ── */
    public function bookingTypes(Request $request)
    {
        $service = $request->query('service');
        if ($service === 'tour') {
            $types = DB::table('itinerary')->select('id', 'title as name')->get();
        } elseif ($service === 'car') {
            $types = Vehicle::with('brand', 'model')->latest()->get()
                ->map(fn($v) => (object)[
                    'id'   => $v->id,
                    'name' => trim(optional($v->brand)->name . ' ' . optional($v->model)->name . ' ' . $v->production_year),
                ])->values();
        } else {
            $types = collect([
                (object)['id' => 'airport', 'name' => 'Airport Transfer'],
                (object)['id' => 'hotel',   'name' => 'Hotel Transfer'],
                (object)['id' => 'city',    'name' => 'City Transfer'],
            ]);
        }
        return response()->json($types);
    }

    /* ── Profile ── */
    public function profile()
    {
        $user = Auth::user();
        return view('client.profile', compact('user'));
    }

    /* ── Update profile info + avatar ── */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|max:2048',
        ]);

        $data = ['name' => $request->name, 'email' => $request->email];

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = Storage::url($path);
        }

        DB::table('users')->where('id', $user->id)->update($data);

        return back()->with('profile_success', 'Profile updated successfully.');
    }

    /* ── Change password ── */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->with('open_password', true);
        }

        DB::table('users')->where('id', $user->id)->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('password_success', 'Password changed successfully.');
    }
}
