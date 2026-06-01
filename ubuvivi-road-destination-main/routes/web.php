<?php

use \App\Http\Controllers\deleteImageController;
use \App\Http\Controllers\GuestController;
use \App\Http\Controllers\HomeController;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


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

    Route::get("/transfer/book", 'transfer_book_form')->name("transfer.book.form");
    Route::post("/transfer/book", 'transfer_book_store')->name("transfer.book.store");

    Route::get("/event/book", 'event_book_form')->name("event.book.form");
    Route::post("/event/book", 'event_book_store')->name("event.book.store");

    Route::get("/blog", 'blog_list')->name("blog.index");
    Route::get("/blog/{slug}", 'blog_show')->name("blog.show");

    Route::get("/flights/search",         'flight_search')->name("guest.flights.search");
    Route::get("/flights/search/results", 'flight_results')->name("guest.flights.results");
    Route::post("/flights/book",          'flight_book_store')->name("guest.flights.book.store");

    Route::get("/hotels/search", 'booking_com_search')->name("guest.hotels.search");
    Route::get("/hotels/search/results", 'booking_com_results')->name("guest.hotels.results");
    Route::get("/hotels/book/{hotel_id}", 'booking_com_hotel_detail')->name("guest.hotels.book");
    Route::post("/hotels/book", 'booking_com_hotel_store')->name("guest.hotels.book.store");

    Route::post("/newsletter/subscribe", 'newsletter_subscribe')->name("newsletter.subscribe");

    Route::get("/booking/confirmed", 'bookingConfirmed')->name("booking.confirmed");

    Route::post("/air-ticketing/book", 'air_ticketing_store')->name("air.ticketing.store");
    Route::post("/hotel-booking/book", 'hotel_booking_store')->name("hotel.booking.store");

    Route::get("/tour/pay/{id}", 'tour_payment_form')->name("tour.payment.form");

    Route::get("/car/booking/pay/{id}", 'car_booking_payment_form')->name("car.booking.payment.form");

    Route::get("/car/transfer/pay/{id}", 'car_transfer_payment_form')->name("car.transfer.payment.form");

    Route::get("/tour/pay/check/{id}", 'tour_payment_check')->name("tour.payment.check");

    Route::get("/car/pay/check/{id}", 'car_payment_check')->name("car.payment.check");

    Route::get("/car/booking/{id}", 'car_booking_view')->name("car.booking.view");

    Route::get("/car/transfer/{id}", 'car_transfer_view')->name("car.transfer.view");

    Route::get("/tour/booking/{id}", 'tour_booking_view')->name("tour.booking.view");

    Route::get("/tour/booking/{id}/account", 'tour_booking_account')->name("tour.booking.account");

    Route::middleware('validate.booking.token')->group(function () {
        Route::get('/booking/{type}/{token}', function ($type, $token) {
            $booking = request()->booking;

            if ($type === 'car') {
                return redirect()->route('car.booking.view', $booking->id);
            } elseif ($type === 'tour') {
                return redirect()->route('tour.booking.view', $booking->id);
            } elseif ($type === 'flight') {
                return view('flight.booking_view', ['booking' => $booking]);
            } elseif ($type === 'hotel') {
                return view('hotel.booking_view', ['booking' => $booking]);
            } elseif ($type === 'transfer') {
                return redirect()->route('car.transfer.view', $booking->id);
            }
        })->where('type', 'car|tour|flight|hotel|transfer');

        Route::get('/booking/{type}/{token}', function ($type, $token) {
            return redirect()->route('car.booking.token.view', [$type, $token]);
        })->name('car.booking.token.view')->where('type', 'car|tour|flight|hotel|transfer');

        Route::get('/booking/{type}/{token}', function ($type, $token) {
            return redirect()->route('car.booking.token.view', [$type, $token]);
        })->name('tour.booking.token.view')->where('type', 'car|tour|flight|hotel|transfer');

        Route::get('/booking/{type}/{token}', function ($type, $token) {
            return redirect()->route('car.booking.token.view', [$type, $token]);
        })->name('flight.booking.token.view')->where('type', 'car|tour|flight|hotel|transfer');

        Route::get('/booking/{type}/{token}', function ($type, $token) {
            return redirect()->route('car.booking.token.view', [$type, $token]);
        })->name('hotel.booking.token.view')->where('type', 'car|tour|flight|hotel|transfer');

        Route::get('/booking/{type}/{token}', function ($type, $token) {
            return redirect()->route('car.booking.token.view', [$type, $token]);
        })->name('car.transfer.token.view')->where('type', 'car|tour|flight|hotel|transfer');
    });

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
    Route::get('/services/{type}/{id}/data', [App\Http\Controllers\Admin\ServiceController::class, 'getData'])->name('services.getData');
    Route::get('/services/{id}/edit', [App\Http\Controllers\Admin\ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [App\Http\Controllers\Admin\ServiceController::class, 'destroy'])->name('services.destroy');
    
    Route::get('/admin/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blog.admin.index');
    Route::post('/admin/blog', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('blog.admin.store');
    Route::get('/admin/blog/{id}/data', [App\Http\Controllers\Admin\BlogController::class, 'getData'])->name('blog.admin.getData');
    Route::put('/admin/blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('blog.admin.update');
    Route::delete('/admin/blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('blog.admin.destroy');

    // Hotels
    Route::get('/admin/hotels', [App\Http\Controllers\Admin\HotelController::class, 'index'])->name('admin.hotels.index');
    Route::post('/admin/hotels', [App\Http\Controllers\Admin\HotelController::class, 'store'])->name('admin.hotels.store');
    Route::get('/admin/hotels/{id}/data', [App\Http\Controllers\Admin\HotelController::class, 'getData'])->name('admin.hotels.getData');
    Route::put('/admin/hotels/{id}', [App\Http\Controllers\Admin\HotelController::class, 'update'])->name('admin.hotels.update');
    Route::delete('/admin/hotels/{id}', [App\Http\Controllers\Admin\HotelController::class, 'destroy'])->name('admin.hotels.destroy');

    // Newsletter Subscribers
    Route::get('/admin/subscribers', [App\Http\Controllers\Admin\SubscriberController::class, 'index'])->name('admin.subscribers.index');
    Route::delete('/admin/subscribers/{id}', [App\Http\Controllers\Admin\SubscriberController::class, 'destroy'])->name('admin.subscribers.destroy');
    Route::post('/admin/subscribers/send', [App\Http\Controllers\Admin\SubscriberController::class, 'sendNewsletter'])->name('admin.subscribers.send');

    // Notifications
    Route::get('/admin/notifications', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('admin.notifications.index');
    Route::post('/admin/notifications/read-all', [App\Http\Controllers\Admin\NotificationController::class, 'markAllRead'])->name('admin.notifications.readAll');
    Route::post('/admin/notifications/{id}/read', [App\Http\Controllers\Admin\NotificationController::class, 'markRead'])->name('admin.notifications.read');

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
    Route::put('/client/profile',        [\App\Http\Controllers\ClientDashboardController::class, 'updateProfile'])->name('client.profile.update');
    Route::put('/client/profile/password', [\App\Http\Controllers\ClientDashboardController::class, 'updatePassword'])->name('client.profile.password');
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

    Route::resource('carTransfers', \App\Http\Controllers\CarTransferController::class);
    Route::resource('itineraries',  \App\Http\Controllers\ItineraryController::class);
});
