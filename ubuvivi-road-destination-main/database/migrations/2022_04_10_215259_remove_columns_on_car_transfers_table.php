<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnsOnCarTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("car_transfers", function (Blueprint $table) {
            $table->dropColumn("delivery_location", "delivery_date", "delivery_time");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("car_transfers", function (Blueprint $table) {
            $table->addColumn("date", "delivery_location")->nullable();
            $table->addColumn("date", "delivery_date")->nullable();
            $table->addColumn("date", "delivery_time")->nullable();
        });
    }
}
