<?php

use \App\Http\Controllers\deleteImageController;
use \App\Http\Controllers\GuestController;
use \App\Http\Controllers\HomeController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post("/contact", [GuestController::class, "sendMessage"]);

Route::controller(GuestController::class)->group(function () {
    Route::get("/", 'home')->name("guest.home");

    Route::get("/about", 'about')->name("guest.about");

    Route::get("/services", 'services')->name("guest.services");

    Route::get("/contact", 'contact')->name("guest.contact");

    Route::get("/cars", 'car_list')->name("car.list");

    Route::get("/tours", 'tours_list');

    Route::get("/car/{id}", 'car_view')->name("car.view");

    Route::get("/tour/{id}", 'tour_view')->name("tour.view");

    Route::post('/brand/{brand}/models', 'getModelByBrand')->name("brand.models");

    Route::post("/tour/pay/{id}", 'tour_payment')->name("tour.pay");

    Route::post("/car/booking/pay/{id}", 'car_booking_payment')->name("car.booking.pay");

    Route::post("/car/transfer/pay/{id}", 'car_transfer_payment')->name("car.transfer.pay");

    Route::get("/tour/pay/{id}", 'tour_payment_form')->name("tour.payment.form");

    Route::get("/car/booking/pay/{id}", 'car_booking_payment_form')->name("car.booking.payment.form");

    Route::get("/car/transfer/pay/{id}", 'car_transfer_payment_form')->name("car.transfer.payment.form");

    Route::get("/tour/pay/check/{id}", 'tour_payment_check')->name("tour.payment.check");

    Route::get("/car/pay/check/{id}", 'car_payment_check')->name("car.payment.check");

    Route::get("/car/booking/{id}", 'car_booking_view')->name("car.booking.view");

    Route::get("/car/transfer/{id}", 'car_transfer_view')->name("car.transfer.view");

    Route::get("/tour/booking/{id}", 'tour_booking_view')->name("tour.booking.view");

    Route::group(["prefix" => "booking"], function () {
        Route::get("/car/{id}", "car_booking")->name("car.booking");

        Route::get("/tour/{id}", "tour_booking")->name("tour.booking");

        Route::post("/car/{id}", "car_booking_continue")->name("car.book.continue");

        Route::post("/car/{id}/book", "car_booking_store")->name("car.book");

        Route::post("/tour/{id}/book", "tour_booking_store")->name("tour.book");

        Route::get("tour/success/{id}", "tour_booking_store_success")->name("tour.book.success");

        Route::get("car/success/{type}/{id}", "car_booking_store_success")->name("car.book.success");
    });
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::controller(deleteImageController::class)->group(function () {
    Route::post("/vehicle/image/delete", 'vehicle');
    Route::post("/itinerary/image/delete", 'itinerary');
});

Route::middleware("auth")->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::resource('vehicles', \App\Http\Controllers\VehicleController::class);

    Route::resource('packages', \App\Http\Controllers\PackageController::class);

    Route::resource('payments', \App\Http\Controllers\PaymentController::class);

    Route::resource('bookings', \App\Http\Controllers\BookingController::class);

    Route::group(['prefix' => 'types'], function () {
        Route::resource('bookingTypes', \App\Http\Controllers\Types\BookingTypeController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('fuelTypes', \App\Http\Controllers\Types\FuelTypeController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('transmissions', \App\Http\Controllers\Types\TransmissionController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('vehicleBrands', \App\Http\Controllers\Types\VehicleBrandController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('vehicleModels', \App\Http\Controllers\Types\VehicleModelController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('fuelTypes', \App\Http\Controllers\Types\FuelTypeController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('bookingTypes', \App\Http\Controllers\Types\BookingTypeController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('fuelTypes', \App\Http\Controllers\Types\FuelTypeController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('bookingTypes', \App\Http\Controllers\Types\BookingTypeController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('vehicleBrands', \App\Http\Controllers\Types\VehicleBrandController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('vehicleModels', \App\Http\Controllers\Types\VehicleModelController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('bookingTypes', \App\Http\Controllers\Types\BookingTypeController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('vehicleModels', \App\Http\Controllers\Types\VehicleModelController::class, ["as" => 'types']);
    });

    Route::group(['prefix' => 'types'], function () {
        Route::resource('bookingTypes', \App\Http\Controllers\Types\BookingTypeController::class, ["as" => 'types']);
    });


    Route::group(['prefix' => 'types'], function () {
        Route::resource('fuelTypes', \App\Http\Controllers\Types\FuelTypeController::class, ["as" => 'types']);
    });


    Route::group(['prefix' => 'types'], function () {
        Route::resource('vehicleBrands', \App\Http\Controllers\Types\VehicleBrandController::class, ["as" => 'types']);
    });


    Route::group(['prefix' => 'types'], function () {
        Route::resource('vehicleModels', \App\Http\Controllers\Types\VehicleModelController::class, ["as" => 'types']);
    });

    Route::resource('carBookings', \App\Http\Controllers\CarBookingController::class);

    Route::resource('carTransfers', \App\Http\Controllers\CarTransferController::class);


    Route::resource('itineraries', \App\Http\Controllers\ItineraryController::class);


    Route::resource('tourBookings', \App\Http\Controllers\TourBookingController::class);


    Route::resource('tourBookings', \App\Http\Controllers\TourBookingController::class);

    Route::resource('tourBookings', \App\Http\Controllers\TourBookingController::class);
});
