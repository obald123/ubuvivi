<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NullableApprovedColumnOnTourBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_bookings', function (Blueprint $table) {
            $table->boolean("approved")->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_bookings', function (Blueprint $table) {
            $table->boolean("approved")->nullable(false)->default(false)->change();
        });
    }
}
