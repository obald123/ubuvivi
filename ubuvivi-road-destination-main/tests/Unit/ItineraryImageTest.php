<?php

namespace Tests\Unit;

use App\Models\Itinerary;
use Tests\TestCase;

class ItineraryImageTest extends TestCase
{
    public function test_itinerary_image_arrays_are_json_encoded_for_database_storage()
    {
        $itinerary = new Itinerary();
        $itinerary->images = ['https://example.test/tour.jpg'];
        $itinerary->image_id = ['ubuvivi/tour'];

        $this->assertSame('["https:\/\/example.test\/tour.jpg"]', $itinerary->getAttributes()['images']);
        $this->assertSame('["ubuvivi\/tour"]', $itinerary->getAttributes()['image_id']);
        $this->assertSame(['https://example.test/tour.jpg'], $itinerary->images);
        $this->assertSame(['ubuvivi/tour'], $itinerary->image_id);
    }

    public function test_itinerary_image_accessors_read_existing_double_encoded_values()
    {
        $itinerary = new Itinerary();
        $itinerary->setRawAttributes([
            'images' => json_encode(json_encode(['https://example.test/tour.jpg'])),
            'image_id' => json_encode(json_encode(['ubuvivi/tour'])),
        ]);

        $this->assertSame(['https://example.test/tour.jpg'], $itinerary->images);
        $this->assertSame(['ubuvivi/tour'], $itinerary->image_id);
    }
}
