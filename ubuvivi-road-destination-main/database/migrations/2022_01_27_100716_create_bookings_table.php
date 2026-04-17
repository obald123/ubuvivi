<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId("booking_type_id")->nullable()->constrained("booking_types")->onDelete("SET NULL");
            $table->foreignId("package_id")->nullable()->constrained("packages")->onDelete("SET NULL");
            $table->longText("price");
            $table->string("departure_address");
            $table->string("arrival_address");
            $table->date("departure_time");
            $table->date("arrival_time")->nullable();
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
        Schema::dropIfExists('bookings');
    }
}
