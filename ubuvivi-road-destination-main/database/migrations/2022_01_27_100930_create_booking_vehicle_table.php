<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_vehicle', function (Blueprint $table) {
            $table->foreignID("booking_id")->constrained('bookings')->onDelete("cascade");
            $table->foreignID("vehicle_id")->constrained('vehicles')->onDelete("cascade");
            $table->primary(["booking_id", "vehicle_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_vehicle');
    }
}
