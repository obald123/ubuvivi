<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenToBookings extends Migration
{
    public function up()
    {
        Schema::table('car_bookings', function (Blueprint $table) {
            $table->string('access_token')->unique()->nullable()->after('approved');
            $table->index('access_token');
        });

        Schema::table('tour_bookings', function (Blueprint $table) {
            $table->string('access_token')->unique()->nullable()->after('approved');
            $table->index('access_token');
        });

        Schema::table('flight_bookings', function (Blueprint $table) {
            $table->string('access_token')->unique()->nullable()->after('approved');
            $table->index('access_token');
        });

        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->string('access_token')->unique()->nullable()->after('approved');
            $table->index('access_token');
        });

        Schema::table('car_transfers', function (Blueprint $table) {
            $table->string('access_token')->unique()->nullable()->after('approved');
            $table->index('access_token');
        });
    }

    public function down()
    {
        Schema::table('car_bookings', function (Blueprint $table) {
            $table->dropUnique(['access_token']);
            $table->dropIndex(['access_token']);
            $table->dropColumn('access_token');
        });

        Schema::table('tour_bookings', function (Blueprint $table) {
            $table->dropUnique(['access_token']);
            $table->dropIndex(['access_token']);
            $table->dropColumn('access_token');
        });

        Schema::table('flight_bookings', function (Blueprint $table) {
            $table->dropUnique(['access_token']);
            $table->dropIndex(['access_token']);
            $table->dropColumn('access_token');
        });

        Schema::table('hotel_bookings', function (Blueprint $table) {
            $table->dropUnique(['access_token']);
            $table->dropIndex(['access_token']);
            $table->dropColumn('access_token');
        });

        Schema::table('car_transfers', function (Blueprint $table) {
            $table->dropUnique(['access_token']);
            $table->dropIndex(['access_token']);
            $table->dropColumn('access_token');
        });
    }
}
