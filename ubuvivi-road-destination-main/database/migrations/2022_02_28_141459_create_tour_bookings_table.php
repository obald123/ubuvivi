<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_id')->nullable()->constrained("itinerary")->onDelete("SET NULL");
            $table->string("names");
            $table->string("email");
            $table->string("phone_number");
            $table->string("date");
            $table->longText("message");
            $table->string("price")->nullable();
            $table->boolean("approved")->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour_bookings');
    }
}
