<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag')->nullable();
            $table->string('image')->nullable();
            $table->string('image_id')->nullable();
            // Ids of the closest other destinations, used to suggest alternatives
            // when a destination has no hotels of its own.
            $table->json('nearby')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Seed the destinations that were previously hardcoded in the controller
        // so the public page keeps working the moment this migration runs.
        $seed = [
            ['name' => 'Kigali',  'image' => 'assets/images/backgrounds/download (6).jpg', 'nearby' => ['Musanze', 'Huye', 'Akagera']],
            ['name' => 'Musanze', 'image' => 'assets/images/backgrounds/download (7).jpg', 'nearby' => ['Rubavu', 'Kigali']],
            ['name' => 'Rubavu',  'image' => 'assets/images/backgrounds/download (8).jpg', 'nearby' => ['Musanze', 'Karongi']],
            ['name' => 'Karongi', 'image' => 'assets/images/backgrounds/images.jpg',       'nearby' => ['Rubavu', 'Nyungwe', 'Kigali']],
            ['name' => 'Nyungwe', 'image' => 'assets/images/backgrounds/bg_7.jpg',         'nearby' => ['Huye', 'Karongi']],
            ['name' => 'Akagera', 'image' => 'assets/images/backgrounds/bg_8.jpg',         'nearby' => ['Kigali']],
            ['name' => 'Huye',    'image' => 'images/huye.jpg',                            'nearby' => ['Nyungwe', 'Kigali']],
        ];

        $now = now();

        foreach ($seed as $i => $row) {
            DB::table('destinations')->insert([
                'name'       => $row['name'],
                'tag'        => 'Rwanda',
                'image'      => $row['image'],
                'sort_order' => $i,
                'active'     => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        // Second pass: "nearby" is stored by id, which only exists after insert.
        $idsByName = DB::table('destinations')->pluck('id', 'name');

        foreach ($seed as $row) {
            $nearbyIds = [];

            foreach ($row['nearby'] as $name) {
                if (isset($idsByName[$name])) {
                    $nearbyIds[] = (int) $idsByName[$name];
                }
            }

            DB::table('destinations')
                ->where('id', $idsByName[$row['name']])
                ->update(['nearby' => json_encode($nearbyIds)]);
        }
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
}
