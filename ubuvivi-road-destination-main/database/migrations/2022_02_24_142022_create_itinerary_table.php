<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItineraryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("description");
            $table->longText("images")->default(serialize([]));
            $table->longText("highlights")->default(serialize([]));
            $table->longText("days_description")->default(serialize([]));
            $table->longText("inclusions")->default(serialize([]));
            $table->longText("exclusions")->default(serialize([]));
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
        Schema::dropIfExists('itinerary');
    }
}
