<?php

namespace App\Http\Controllers;

use App\Mail\AdminBookingMail;
use App\Mail\BookingMail;
use App\Mail\ContactMail;
use App\Models\CarBooking;
use App\Models\CarTransfer;
use App\Models\Itinerary;
use App\Models\Payment;
use App\Models\TourBooking;
use App\Models\Types\VehicleBrand;
use App\Models\Types\VehicleModel;
use App\Models\Vehicle;
use App\Repositories\CarBookingRepository;
use App\Repositories\CarTransferRepository;
use App\Repositories\TourBookingRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use Paypack\Paypack;

class GuestController extends Controller
{

    private $carBookingRepository;
    private $carTransferRepository;
    private $tourBookingRepository;

    public function __construct(CarBookingRepository $carBookingRepo, CarTransferRepository $carTransferRepo, TourBookingRepository $tourBookingRepo)
    {
        $this->carBookingRepository = $carBookingRepo;
        $this->carTransferRepository = $carTransferRepo;
        $this->tourBookingRepository = $tourBookingRepo;
    }

    public function sendMail($email, $link)
    {

        $data = ["link" => $link, 'email' => $email];

        try {
            Mail::send(new BookingMail($data));
            Flash::success("Mail Sent Successfully");
        } catch (\Throwable $th) {
            //throw $th;
            Flash::error("Failed To send Email");
        }
    }

    public function notify_admin($booking, $link)
    {
        $data = ["booking" => $booking, "link" => $link, 'email' => $booking->email, 'names' => $booking->names];

        try {
            Mail::send(new AdminBookingMail($data));
            Flash::success("Mail Sent Successfully");
        } catch (\Throwable $th) {
            //throw $th;
            Flash::error("Failed To send Email");
        }
    }

    public function paypack()
    {
        $paypack = new Paypack();

        $paypack->config([
            'client_id' => env("paypack_client_id"),
            'client_secret' => env("paypack_client_secret")
        ]);

        return $paypack;
    }

    public function home()
    {
        return view("welcome");
    }

    public function about()
    {

        return view("about");
    }

    public function all_services()
    {
        return view("all-services");
    }

    public function services()
    {
        $transfers = \App\Models\Transfer::latest()->get();
        return view("services")->with(compact("transfers"));
    }

    public function events()
    {
        $events = \App\Models\Event::latest()->get();
        return view("events")->with(compact("events"));
    }

    public function air_ticketing()
    {
        return view("air_ticketing");
    }

    public function hotel_booking()
    {
        return view("hotel-booking");
    }

    public function tours_booking_options()
    {
        return view("tours_booking_options");
    }

    public function tours_booking()
    {
        return view("tours_booking");
    }

    public function contact()
    {

        return view("contact");
    }

    public function car_list(Request $request)
    {

        $brand = $request->query("vehicle_brand");
        $model = $request->query("vehicle_model");

        $vehicles = Vehicle::with("brand", "model", "transmission", "fuelType");

        if ($brand) {
            $vehicles = $vehicles->whereHas('brand', function ($q) use ($brand) {
                return $q->where("name", $brand);
            });
        }

        if ($model) {
            $vehicles = $vehicles->whereHas('model', function ($q) use ($model) {
                return $q->where("name", $model);
            });
        }

        $vehicles = $vehicles->latest()->get();

        $models = null;
        $brands = null;

        if (!empty($vehicles)) {
            $models = VehicleModel::latest()->get();
            $brands = VehicleBrand::latest()->get();
        }

        return view("car.list")->with(compact("vehicles", "models", "brands"));
    }


    public function car_view($id)
    {
        $vehicle = Vehicle::find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect()->back();
        }

        return view("car.view", compact("vehicle"));
    }

    public function car_booking($id)
    {
        $vehicle = Vehicle::with("brand", "model")->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect()->back();
        }

        $brands = VehicleBrand::latest()->get();
        $models = VehicleModel::latest()->get();

        return view("car.booking", compact("vehicle", "brands", "models"));
    }

    public function car_booking_continue(Request $request, $id)
    {
        $name = $request->name;
        $email = $request->email;
        $phone_number = $request->phone_number;
        $booking_type = $request->booking_type;

        $vehicle = Vehicle::with("brand", "model")->find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect()->back();
        }

        $brands = VehicleBrand::latest()->get();
        $models = VehicleModel::latest()->get();

        return view("car.booking", compact("vehicle", "name", "email", "phone_number", "booking_type", "brands", "models"));
    }

    public function car_find(Request $request)
    {
        $brand = $request->query("vehicle_brand");
        $model = $request->query("vehicle_model");
        $price = $request->query("price");

        $query = Vehicle::query();
        if ($brand) {
            $query->whereHas('brand', function ($q) use ($brand) { $q->where("name", $brand); });
        }
        if ($model) {
            $query->whereHas('model', function ($q) use ($model) { $q->where("name", $model); });
        }
        if ($price === 'low') {
            $query->orderBy('price', 'asc');
        } elseif ($price === 'high') {
            $query->orderBy('price', 'desc');
        }

        $matches = $query->get();

        if ($brand && $model && $matches->count() === 1) {
            return redirect()->route('car.booking', $matches->first()->id);
        }

        return redirect()->route('car.list', $request->query());
    }

    public function car_booking_store_success(Request $request, $type, $id)
    {
        $message = null;
        $booking_route = null;

        if ($type == "1") {
            $booking = CarBooking::find($id);
            $booking_route = route("car.booking.view", $booking->id);
        } else {
            $booking = CarTransfer::find($id);
            $booking_route = route("car.transfer.view", $booking->id);
        }

        if (empty($booking)) {
            $message = "Booking not found";
        }


        return view("car.booking_success", compact("message", "booking", "booking_route"));
    }

    public function car_booking_store(Request $request, $id)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|string|email|max:255",
            "phone_number" => "required|string|max:20",
            "booking_type" => "required|in:1,2",
            "pickup_date" => "required|date",
            "pickup_time" => "required|string|max:8",
            "pickup_meridiem" => "nullable|in:AM,PM",
            "return_date" => "required|date|after_or_equal:pickup_date",
            "return_time" => "required|string|max:8",
            "return_meridiem" => "nullable|in:AM,PM",
            "destination" => "nullable|string|max:255",
            "message" => "nullable|string",
        ]);

        $vehicle = Vehicle::find($id);

        if (empty($vehicle)) {
            Flash::error('Vehicle not found');

            return redirect()->back();
        }

        $pickupTime = trim($request->pickup_time . ' ' . ($request->pickup_meridiem ?? ''));
        $returnTime = trim($request->return_time . ' ' . ($request->return_meridiem ?? ''));

        try {
            $start = \Carbon\Carbon::parse($request->pickup_date);
            $end   = \Carbon\Carbon::parse($request->return_date);
            $days  = max(1, $end->diffInDays($start) + 1);
        } catch (\Throwable $th) {
            $days = 1;
        }

        $booking = $this->carBookingRepository->create([
            "names" => $request->name,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "booking_type" => $request->booking_type == "2" ? "with_driver" : "self_drive",
            "destination" => $request->booking_type == "2" ? ($request->destination ?? "") : null,
            "number_of_days" => $days,
            "delivery_date" => $request->pickup_date,
            "delivery_time" => $pickupTime,
            "return_date" => $request->return_date,
            "return_time" => $returnTime,
            "delivery_location" => $request->destination ?? "",
            "message" => $request->message ?? "",
            "price" => $vehicle->price * $days,
            "approved" => false,
        ]);

        // Properly link booking to vehicle
        \DB::table('vehicle_bookings')->insert([
            'car_booking_id' => $booking->id,
            'vehicle_id' => $vehicle->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($booking) {
            Flash::success("Booking information sent successfully");

            $admin_booking_route = route("carBookings.show", $booking->id);
            $booking_route = route("car.booking.view", $booking->id);

            try {
                $this->notify_admin($booking, $admin_booking_route);
                $this->sendMail($request->email, $booking_route);
            } catch (\Throwable $th) {
            }
        } else {
            Flash::error("Booking Failed");
        }

        return redirect()->route("car.book.success", ["1", $booking->id]);
    }


    public function tour_booking_view($id)
    {
        $booking = TourBooking::with("tour")->find($id);
        $message = "Something unexpected happened";

        if (empty($booking)) {
            $message = "We couldn't find this booking in our records";
            return view("tours.booking_view")->with(compact("booking", "message"));
        }

        if (empty($booking->tour)) {
            $message = "We couldn't find any tour associated to your booking, please try booking again.";
            return view("tours.booking_view")->with(compact("booking", "message"));
        }

        $itinerary = $booking->tour;
        $itinerary->images = $itinerary->images ? $itinerary->images : array();
        $itinerary->highlights = $itinerary->highlights ? $itinerary->highlights : array();
        $itinerary->inclusions = $itinerary->inclusions ? $itinerary->inclusions : array();
        $itinerary->exclusions = $itinerary->exclusions ? $itinerary->exclusions : array();
        $itinerary->days_description = $itinerary->days_description ? $itinerary->days_description : array();

        return view("tours.booking_view", compact("booking", "itinerary"));
    }

    public function car_booking_view($id)
    {
        $booking = CarBooking::with("vehicle")->find($id);
        $message = "Something unexpected happened";
        $error = false;
        $vehicle = null;

        if (empty($booking)) {
            $error = true;
            $message = "We couldn't find this booking in our records";
        } else {
            $booking->booking_type = 1;
        }

        if (empty($booking->vehicle)) {
            $error = true;
            $message = "We couldn't find any Vehicle associated to your booking, please try booking again.";
        } else {
            $vehicle = $booking->vehicle->first();
            if (!$vehicle) {
                $error = true;
                $message = "We couldn't find any Vehicle associated to your booking, please try booking again.";
            } else {
                $vehicle->images = $vehicle->images ? $vehicle->images : array();
            }
        }

        return view("car.booking_view")->with(compact("booking", "vehicle", "message", "error"));
    }

    public function car_transfer_view($id)
    {
        $booking = CarTransfer::with("vehicle")->find($id);
        $message = "Something unexpected happened";
        $error = false;
        $vehicle = null;

        if (empty($booking)) {
            $error = true;
            $message = "We couldn't find this booking in our records";
        }

        if (empty($booking->vehicle)) {
            $error = true;
            $message = "We couldn't find any tour associated to your booking, please try booking again.";
        } else {
            $vehicle = $booking->vehicle->first();
            $vehicle->images = $vehicle->images ? $vehicle->images : array();
        }

        $booking->booking_type = 2;


        return view("car.booking_view")->with(compact("booking", "vehicle", "message", "error",));
    }


    // tour controller

    public function tours_list()
    {
        $tours = Itinerary::latest()->get();

        return view("tours.list")->with(compact("tours"));
    }

    public function tour_view($id)
    {
        $tour = Itinerary::find($id);

        if (empty($tour)) {
            Flash::error('Tour not found');

            return redirect()->back();
        }

        $tour->images = $tour->images ? $tour->images : array();
        $tour->highlights = $tour->highlights ? $tour->highlights : array();
        $tour->inclusions = $tour->inclusions ? $tour->inclusions : array();
        $tour->exclusions = $tour->exclusions ? $tour->exclusions : array();
        $tour->days_description = $tour->days_description ? $tour->days_description : array();

        return view("tours.view", compact("tour"));
    }

    public function tour_booking($id)
    {
        $tour = Itinerary::find($id);

        if (empty($tour)) {
            Flash::error('Tour not found');

            return redirect()->back();
        }

        $tour->images = $tour->images ? $tour->images : array();
        $tour->highlights = $tour->highlights ? $tour->highlights : array();
        $tour->inclusions = $tour->inclusions ? $tour->inclusions : array();
        $tour->exclusions = $tour->exclusions ? $tour->exclusions : array();
        $tour->days_description = $tour->days_description ? $tour->days_description : array();

        return view("tours.booking", compact("tour"));
    }

    public function tour_booking_store_success(Request $request, $id)
    {
        $booking = TourBooking::with("tour")->find($id);
        $message = "Something unexpected happened";

        if (empty($booking)) {
            $message = "We couldn't find your booking in our records";
        } else if (empty($booking->tour)) {
            $message = "We couldn't any tour associated with your booking, please try booking again.";
        }

        return view("tours.booking_success", compact("booking", "message"));
    }

    public function tour_booking_store(Request $request, $id)
    {
        $request->validate([
            "names" => "required|string|max:255",
            "email" => "required|string|max:255",
            "phone_number" => "required|string|max:13",
            "number_of_people" => "nullable",
            "date" => "nullable",
        ]);

        $tour = Itinerary::find($id);

        if (empty($tour)) {
            Flash::error('Tour not found');

            return redirect()->back();
        }

        $input = $request->all();
        $input["itinerary_id"] =  $tour->id;
        $input['number_of_people'] = $input['number_of_people'] ?? 1;
        $input['date'] = $input['date'] ?? "";
        $input['message'] = $input['message'] ?? "";

        $booking = $this->tourBookingRepository->create($input);

        if ($booking) {
            Flash::success("Booking information sent successfully");
            try {
                $this->notify_admin($booking, route("tourBookings.show", $booking->id));
                $this->sendMail($request->email, route("tour.booking.view", $booking->id));
            } catch (\Throwable $th) {
                // throw $th;
            }
        } else {
            Flash::error("Booking Failed");
        }

        return redirect()->route("tour.book.success", $booking->id);
    }

    public function tour_payment_form(Request $request, $id)
    {
        $booking = TourBooking::with("tour")->find($id);
        $error = false;
        $message = "An error occured";

        if (empty($booking)) {
            $error = true;
            $message = "This Booking is not found in our records";
            return view("tours.pay", compact("message", "booking", "error"));
        }

        return view("tours.pay", compact("booking", "error", "message"));
    }

    public function car_booking_payment_form($id)
    {
        $booking = CarBooking::with("vehicle")->find($id);
        $error = false;
        $message = "An error occured";
        $booking_type = 1;

        if (empty($booking)) {
            $error = true;
            $message = "This Booking is not found in our records";
        }

        if ($booking->vehicle) {
            $booking->vehicle = $booking->vehicle->first();
        }

        return view("car.pay", compact("booking", "error", "message", "booking_type"));
    }

    public function car_transfer_payment_form($id)
    {
        $booking = CarTransfer::with("vehicle")->find($id);
        $error = false;
        $message = "An error occured";
        $booking_type = 2;

        if (empty($booking)) {
            $error = true;
            $message = "This Booking is not found in our records";
        }

        if ($booking->vehicle) {
            $booking->vehicle = $booking->vehicle->first();
        }

        return view("car.pay", compact("booking", "error", "message", "booking_type"));
    }

    public function tour_payment_check($id)
    {
        $payment = Payment::with("tourBooking")->find($id);
        $error = false;
        $message = "An error occured";

        if (empty($payment)) {
            $error = true;
            $message = "Couldn't find this payment in our records";
        } else {
            try {
                if ($payment->status == "pending") {
                    $paymentInstance = $this->paypack()->Events(["ref" => $payment->transaction_ref]);

                    foreach ($paymentInstance["transactions"] as $transaction) {
                        if ($transaction["data"]["status"] == "failed" || $transaction["data"]["status"] == "successful") {
                            $payment->status = $transaction["data"]["status"];
                            $payment->save();
                        }
                    }
                }
            } catch (\Throwable $th) {
                $error = true;
                $message = "Couldn't find this payment, please seek our assistance";
            }
        }

        return view("tours.check_payment", compact("message", "payment", "error"));
    }

    public function car_payment_check($id)
    {
        $payment = Payment::with("carBooking")->find($id);
        $error = false;
        $message = "An error occured";

        if (empty($payment)) {
            $error = true;
            $message = "Couldn't find this payment in our records";
        } else {
            try {
                if ($payment->status == "pending") {
                    $paymentInstance = $this->paypack()->Events(["ref" => $payment->transaction_ref]);

                    foreach ($paymentInstance["transactions"] as $transaction) {
                        if ($transaction["data"]["status"] == "failed" || $transaction["data"]["status"] == "successful") {
                            $payment->status = $transaction["data"]["status"];
                            $payment->save();
                        }
                    }
                }
            } catch (\Throwable $th) {
                $error = true;
                $message = "Couldn't find this payment, please seek our assistance";
            }
        }

        return view("car.check_payment", compact("message", "payment", "error"));
    }

    public function tour_payment(Request $request, $id)
    {
        $booking = TourBooking::with("tour")->find($id);
        $error = false;
        $message = "An error occured";

        if (empty($booking)) {
            $error = true;
            $message = "This Booking is not found in our records";
            return view("tours.pay", compact("message", "booking", "error"));
        }

        try {
            $paymentInstance = $this->paypack()->Cashin(["phone" => "0" . request()->phone_number, "amount" => $booking->price]);
            if (isset($paymentInstance['ref'])) {
                $payment = Payment::create([
                    "tour_booking_id" => $booking->id,
                    "status" => $paymentInstance["status"],
                    "transaction_ref" => $paymentInstance["ref"]
                ]);

                return redirect()->route("tour.payment.check", $payment->id);
            } else {
                $error = true;
                $message = $paymentInstance['message'];

                return view("tours.pay", compact("message", "booking", "error"));
            }
        } catch (\Throwable $th) {
            $error = true;
            $message = "Tour Payment Failed, try again later";
            return view("tours.pay", compact("message", "booking", "error"));
        }
    }

    public function car_booking_payment($id)
    {
        $booking = CarBooking::with("vehicle")->find($id);
        $error = false;
        $message = "An error occured";

        if (empty($booking)) {
            $error = true;
            $message = "This Booking is not found in our records";
            return view("car.pay", compact("message", "booking", "error"));
        }
        try {
            $paymentInstance = $this->paypack()->Cashin(["phone" => "0" . request()->phone_number, "amount" => $booking->price]);



            if (isset($paymentInstance["ref"])) {
                $payment = Payment::create([
                    "car_booking_id" => $booking->id,
                    "status" => $paymentInstance["status"],
                    "transaction_ref" => $paymentInstance["ref"]
                ]);
                return redirect()->route("car.payment.check", $payment->id);
            } else {
                $error = true;
                $message = $paymentInstance['message'];
                return view("car.pay", compact("message", "booking", "error"));
            }
        } catch (\Throwable $th) {
            throw $th;
            $error = true;
            $message = "Vehicle Payment Failed, try again later";
            return view("car.pay", compact("message", "booking", "error"));
        }
    }

    public function car_transfer_payment($id)
    {
        $booking = CarTransfer::with("vehicle")->find($id);
        $error = false;
        $message = "An error occured";

        if (empty($booking)) {
            $error = true;
            $message = "This Booking is not found in our records";
            return view("car.pay", compact("message", "booking", "error"));
        }

        try {
            $paymentInstance = $this->paypack()->Cashin(["phone" => "0" . request()->phone_number, "amount" => $booking->price]);
            if (isset($paymentInstance['ref'])) {
                $payment = Payment::create([
                    "car_transfer_id" => $booking->id,
                    "status" => $paymentInstance["status"],
                    "transaction_ref" => $paymentInstance["ref"]
                ]);

                return redirect()->route("car.payment.check", $payment->id);
            } else {
                $error = true;
                $message = $paymentInstance['message'];

                return view("car.pay", compact("message", "booking", "error"));
            }
        } catch (\Throwable $th) {
            $error = true;
            $message = "Vehicle Payment Failed, try again later";

            return view("car.pay", compact("message", "booking", "error"));
        }
    }

    public function sendMessage(Request $request)
    {
        $this->validate($request, [
            "names" => "required",
            "email" => "required",
            "subject" => "required",
            "message" => "required",
        ]);



        try {
            Mail::send(new ContactMail());
            Flash::success("Message Sent Successfully");
        } catch (\Throwable $th) {
            Flash::error("Failed to send message try again later");
        }

        return view("contact");
    }

    public function getModelByBrand($brand)
    {
        $models = Vehicle::with('model', 'brand')->get()->where('brand.name', "like", $brand)->pluck("model.name", "model.id")->all();
        return $models;
    }
}
