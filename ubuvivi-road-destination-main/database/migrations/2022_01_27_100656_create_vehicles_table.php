<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("brand_id")->nullable()->constrained("vehicle_brands")->onDelete("SET NULL");
            $table->foreignId("model_id")->nullable()->constrained("vehicle_models")->onDelete("SET NULL");
            $table->string("production_year");
            $table->string("plate_number");
            $table->integer("seats");
            $table->integer("price");
            $table->integer("details")->nullable();
            $table->string("currency")->default("$");
            $table->foreignId("transmission_id")->nullable()->constrained("transmissions")->onDelete("SET NULL");
            $table->foreignId("fuel_type_id")->nullable()->constrained("fuel_types")->onDelete("SET NULL");
            $table->integer("one_day_caution");
            $table->integer("other_caution")->nullable();
            $table->string("location")->nullable();
            $table->longText("images")->nullable();
            $table->longText("properties")->nullable();
            $table->boolean("approved")->default(false);
            $table->boolean("for_sale")->default(false);
            $table->boolean("on_lease")->default(false);
            $table->boolean("sold")->default(false);
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
        Schema::dropIfExists('vehicles');
    }
}
