<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtendCarBookingsForQuickBooking extends Migration
{
    public function up()
    {
        Schema::table('car_bookings', function (Blueprint $table) {
            $table->string('return_date')->nullable()->after('delivery_time');
            $table->string('return_time')->nullable()->after('return_date');
            $table->string('booking_type')->nullable()->after('return_time');
            $table->string('destination')->nullable()->after('booking_type');

            $table->string('delivery_location')->nullable()->change();
            $table->string('delivery_date')->nullable()->change();
            $table->string('delivery_time')->nullable()->change();
            $table->string('number_of_days')->nullable()->change();
            $table->longText('message')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('car_bookings', function (Blueprint $table) {
            $table->dropColumn(['return_date', 'return_time', 'booking_type', 'destination']);
        });
    }
}
