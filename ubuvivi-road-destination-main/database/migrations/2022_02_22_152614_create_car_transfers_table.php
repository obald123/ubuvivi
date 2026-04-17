<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_transfers', function (Blueprint $table) {
            $table->id();
            $table->string("names");
            $table->string("email");
            $table->string("phone_number");
            $table->string("pickup_location");
            $table->string("pickup_date");
            $table->string("pickup_time");
            $table->string("delivery_location");
            $table->string("delivery_date");
            $table->string("delivery_time");
            $table->string("number_of_days");
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
        Schema::dropIfExists('car_transfers');
    }
}
