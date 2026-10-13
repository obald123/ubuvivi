<?php

namespace Tests\Unit;

use App\Models\Types\VehicleBrand;
use App\Models\Types\VehicleModel;
use App\Models\Vehicle;
use Tests\TestCase;

class VehicleDisplayTest extends TestCase
{
    public function test_it_decodes_legacy_double_encoded_vehicle_image_arrays()
    {
        $vehicle = new Vehicle();
        $vehicle->setRawAttributes([
            'images' => json_encode(json_encode(['https://example.test/car.jpg'])),
            'image_id' => json_encode(json_encode(['cloudinary/car'])),
        ]);

        $this->assertSame(['https://example.test/car.jpg'], $vehicle->images);
        $this->assertSame(['cloudinary/car'], $vehicle->image_id);
    }

    public function test_it_displays_a_duplicated_brand_and_model_only_once()
    {
        $vehicle = new Vehicle();
        $vehicle->setRelation('brand', new VehicleBrand(['name' => 'Tourism car']));
        $vehicle->setRelation('model', new VehicleModel(['name' => 'Tourism car']));

        $this->assertSame('Tourism car', $vehicle->display_name);
    }

    public function test_it_combines_distinct_brand_and_model_names()
    {
        $vehicle = new Vehicle();
        $vehicle->setRelation('brand', new VehicleBrand(['name' => 'Toyota']));
        $vehicle->setRelation('model', new VehicleModel(['name' => 'Land Cruiser']));

        $this->assertSame('Toyota Land Cruiser', $vehicle->display_name);
    }
}
