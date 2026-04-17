<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_bookings', function (Blueprint $table) {
            $table->foreignId('vehicle_id')->constrained("vehicles")->onDelete("cascade");
            $table->foreignId('car_booking_id')->nullable()->constrained("car_bookings")->onDelete("SET NULL");
            $table->foreignId('car_transfer_id')->nullable()->constrained("car_transfers")->onDelete("SET NULL");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_bookings');
    }
}
