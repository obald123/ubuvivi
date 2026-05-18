<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('email');
            $table->string('phone_number');
            $table->string('airline')->nullable();
            $table->string('departure_airport');
            $table->string('arrival_airport');
            $table->string('trip_type')->default('round');
            $table->string('flight_class')->default('economy');
            $table->integer('number_of_passengers')->default(1);
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->json('passport_photos')->nullable();
            $table->text('additional_info')->nullable();
            $table->boolean('approved')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flight_bookings');
    }
}
