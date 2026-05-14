<?php

use \App\Http\Controllers\deleteImageController;
use \App\Http\Controllers\GuestController;
use \App\Http\Controllers\HomeController;
use App\Mail\TestMail;
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

    Route::get("/our-services", 'all_services')->name("guest.all_services");

    Route::get("/transfer", 'services')->name("guest.transfer");

    Route::get("/events", 'events')->name("guest.events");

    Route::get("/air-ticketing", 'air_ticketing')->name("guest.air_ticketing");

    Route::get("/hotel-booking", 'hotel_booking')->name("guest.hotel_booking");

    Route::get("/tours-booking-options", 'tours_booking_options')->name("guest.tours_booking_options");

    Route::get("/tours-booking", 'tours_booking')->name("guest.tours_booking");

    Route::get("/contact", 'contact')->name("guest.contact");

    Route::get("/cars", 'car_list')->name("car.list");

    Route::get("/car/find", 'car_find')->name("car.find");

    Route::get("/tours", 'tours_list')->name('tour.list');

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

    Route::get("/tour/booking/{id}/account", 'tour_booking_account')->name("tour.booking.account");

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

// Logout route
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


// Admin dashboard (only for admin role)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // New Admin Routes
    Route::get('/requests', [App\Http\Controllers\Admin\RequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/{type}/{id}', [App\Http\Controllers\Admin\RequestController::class, 'show'])->name('requests.show');
    Route::post('/requests/{type}/{id}/status', [App\Http\Controllers\Admin\RequestController::class, 'updateStatus'])->name('requests.updateStatus');
    
    Route::get('/bookings', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{type}/{id}', [App\Http\Controllers\Admin\BookingController::class, 'show'])->name('bookings.show');
    
    Route::get('/services', [App\Http\Controllers\Admin\ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [App\Http\Controllers\Admin\ServiceController::class, 'create'])->name('services.create');
    Route::post('/services', [App\Http\Controllers\Admin\ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}/edit', [App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'destroy'])->name('services.destroy');
    
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/users', [App\Http\Controllers\Admin\ProfileController::class, 'storeUser'])->name('profile.users.store');
    Route::delete('/profile/users/{id}', [App\Http\Controllers\Admin\ProfileController::class, 'destroyUser'])->name('profile.users.destroy');
});

// Client portal
Route::middleware(['auth', 'client'])->group(function () {
    Route::get('/client/dashboard',      [\App\Http\Controllers\ClientDashboardController::class, 'index'])->name('client.dashboard');
    Route::get('/client/bookings',       [\App\Http\Controllers\ClientDashboardController::class, 'bookings'])->name('client.bookings');
    Route::get('/client/notifications',  [\App\Http\Controllers\ClientDashboardController::class, 'notifications'])->name('client.notifications');
    Route::get('/client/new-booking',    [\App\Http\Controllers\ClientDashboardController::class, 'newBooking'])->name('client.new_booking');
    Route::get('/client/booking-types',  [\App\Http\Controllers\ClientDashboardController::class, 'bookingTypes'])->name('client.booking_types');
    Route::get('/client/profile',        [\App\Http\Controllers\ClientDashboardController::class, 'profile'])->name('client.profile');
});

Route::controller(deleteImageController::class)->group(function () {
    Route::post("/vehicle/image/delete", 'vehicle');
    Route::post("/itinerary/image/delete", 'itinerary');
});

Route::middleware("auth")->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::resource('vehicles', \App\Http\Controllers\VehicleController::class);

    Route::resource('packages', \App\Http\Controllers\PackageController::class);

    Route::resource('payments', \App\Http\Controllers\PaymentController::class);


    Route::group(['prefix' => 'types'], function () {
        Route::resource('bookingTypes',  \App\Http\Controllers\Types\BookingTypeController::class,  ["as" => 'types']);
        Route::resource('fuelTypes',     \App\Http\Controllers\Types\FuelTypeController::class,     ["as" => 'types']);
        Route::resource('transmissions', \App\Http\Controllers\Types\TransmissionController::class, ["as" => 'types']);
        Route::resource('vehicleBrands', \App\Http\Controllers\Types\VehicleBrandController::class, ["as" => 'types']);
        Route::resource('vehicleModels', \App\Http\Controllers\Types\VehicleModelController::class, ["as" => 'types']);
    });

    Route::resource('carBookings',  \App\Http\Controllers\CarBookingController::class);
    Route::resource('carTransfers', \App\Http\Controllers\CarTransferController::class);
    Route::resource('itineraries',  \App\Http\Controllers\ItineraryController::class);
    Route::resource('tourBookings', \App\Http\Controllers\TourBookingController::class);
});
