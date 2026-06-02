<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccessTokenToHotelBookings extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('hotel_bookings', 'access_token')) {
            Schema::table('hotel_bookings', function (Blueprint $table) {
                $table->string('access_token')->nullable()->unique()->after('approved');
            });
        }
    }

    public function down()
    {
        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->dropColumn('access_token');
        });
    }
}
