<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id')->nullable();
            $table->string('names');
            $table->string('email');
            $table->string('phone_number');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('number_of_guests')->default(1);
            $table->string('room_type')->nullable();
            $table->text('message')->nullable();
            $table->boolean('approved')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hotel_id')->references('id')->on('hotels')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_bookings');
    }
}
