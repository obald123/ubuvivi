<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDaysToItineraryTable extends Migration
{
    public function up()
    {
        Schema::table('itinerary', function (Blueprint $table) {
            $table->integer('days')->default(1)->after('title');
        });
    }

    public function down()
    {
        Schema::table('itinerary', function (Blueprint $table) {
            $table->dropColumn('days');
        });
    }
}
