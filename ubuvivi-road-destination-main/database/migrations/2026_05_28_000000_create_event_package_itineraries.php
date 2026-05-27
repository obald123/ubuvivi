<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEventPackageItineraries extends Migration
{
    public function up()
    {
        $now = now();

        DB::table('itineraries')->insert([
            [
                'title'           => 'Basic Event Package',
                'description'     => 'Venue only — ideal for self-organised events. Includes conference hall/venue, tables & seating setup, and projector & screen.',
                'number_of_days'  => 1,
                'destination'     => 'Ubuvivi Venue - Kigali',
                'available_from'  => $now,
                'available_to'    => $now->addYears(2),
                'images'          => json_encode([asset('assets/images/events/venue-basic.jpg')]),
                'highlights'      => json_encode([['title' => 'Conference hall/venue'], ['title' => 'Tables & seating setup'], ['title' => 'Projector & screen']]),
                'inclusions'      => json_encode([['title' => 'Venue rental'], ['title' => 'Basic setup'], ['title' => 'AV equipment']]),
                'exclusions'      => json_encode([['title' => 'Catering'], ['title' => 'Transport'], ['title' => 'Accommodation']]),
                'days_description'=> json_encode([['day' => 'Day 1', 'description' => 'Event Day - Fully equipped venue ready for your event']]),
                'price'           => 0,
                'approved'        => true,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'title'           => 'Partial Event Package',
                'description'     => 'Venue + catering for a complete experience. Includes conference hall, catering & refreshments, audio-visual equipment, and on-site event coordinator.',
                'number_of_days'  => 1,
                'destination'     => 'Ubuvivi Venue - Kigali',
                'available_from'  => $now,
                'available_to'    => $now->addYears(2),
                'images'          => json_encode([asset('assets/images/events/venue-partial.jpg')]),
                'highlights'      => json_encode([['title' => 'Conference hall/venue'], ['title' => 'Catering & refreshments'], ['title' => 'Audio-visual equipment'], ['title' => 'On-site event coordinator']]),
                'inclusions'      => json_encode([['title' => 'Venue rental'], ['title' => 'Catering service'], ['title' => 'Professional AV setup'], ['title' => 'Event coordinator']]),
                'exclusions'      => json_encode([['title' => 'Guest transport'], ['title' => 'Accommodation'], ['title' => 'Décor beyond basic setup']]),
                'days_description'=> json_encode([['day' => 'Day 1', 'description' => 'Event Day - Complete venue with catering and professional coordination']]),
                'price'           => 0,
                'approved'        => true,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                'title'           => 'Full Event Package',
                'description'     => 'All-inclusive — we handle everything. Conference hall, catering & refreshments, guest transport & transfers, décor & branding setup, and full on-site support.',
                'number_of_days'  => 1,
                'destination'     => 'Ubuvivi Venue - Kigali',
                'available_from'  => $now,
                'available_to'    => $now->addYears(2),
                'images'          => json_encode([asset('assets/images/events/venue-full.jpg')]),
                'highlights'      => json_encode([['title' => 'Conference hall/venue'], ['title' => 'Catering & refreshments'], ['title' => 'Guest transport & transfers'], ['title' => 'Décor & branding setup'], ['title' => 'Full on-site support']]),
                'inclusions'      => json_encode([['title' => 'Venue rental'], ['title' => 'Complete catering'], ['title' => 'Guest transport'], ['title' => 'Professional décor'], ['title' => 'Full event coordination'], ['title' => 'On-site event team']]),
                'exclusions'      => json_encode([['title' => 'Accommodation (optional)'], ['title' => 'Premium catering upgrades']]),
                'days_description'=> json_encode([['day' => 'Day 1', 'description' => 'Event Day - Fully managed event with all services and support included']]),
                'price'           => 0,
                'approved'        => true,
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ]);
    }

    public function down()
    {
        DB::table('itineraries')
            ->whereIn('title', [
                'Basic Event Package',
                'Partial Event Package',
                'Full Event Package',
            ])
            ->delete();
    }
}
