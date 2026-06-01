<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingComFieldsToHotelBookings extends Migration
{
    public function up()
    {
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->string('source')->default('internal')->after('hotel_id');
            $table->string('booking_com_hotel_id')->nullable()->after('source');
            $table->string('booking_com_hotel_name')->nullable()->after('booking_com_hotel_id');
        });
    }

    public function down()
    {
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->dropColumn(['source', 'booking_com_hotel_id', 'booking_com_hotel_name']);
        });
    }
}
