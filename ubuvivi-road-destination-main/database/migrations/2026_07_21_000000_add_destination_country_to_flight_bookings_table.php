<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDestinationCountryToFlightBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('flight_bookings', function (Blueprint $table) {
            $table->string('destination_country')->nullable()->after('arrival_airport');
        });
    }

    public function down()
    {
        Schema::table('flight_bookings', function (Blueprint $table) {
            $table->dropColumn('destination_country');
        });
    }
}
