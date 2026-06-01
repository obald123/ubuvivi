<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateBookingToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->route('token');
        $bookingType = $request->route('type');

        if (!$token || !$bookingType) {
            return abort(404, 'Booking not found.');
        }

        $booking = null;

        switch ($bookingType) {
            case 'car':
                $booking = \App\Models\CarBooking::findByToken($token);
                break;
            case 'tour':
                $booking = \App\Models\TourBooking::findByToken($token);
                break;
            case 'flight':
                $booking = \App\Models\FlightBooking::findByToken($token);
                break;
            case 'hotel':
                $booking = \App\Models\HotelBooking::findByToken($token);
                break;
            case 'transfer':
                $booking = \App\Models\CarTransfer::findByToken($token);
                break;
            default:
                return abort(404, 'Invalid booking type.');
        }

        if (!$booking) {
            return abort(404, 'Booking not found.');
        }

        $request->merge(['booking' => $booking]);

        return $next($request);
    }
}
