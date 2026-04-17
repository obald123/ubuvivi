<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_id' => $this->faker->word,
        'model_id' => $this->faker->word,
        'production_year' => $this->faker->word,
        'plate_number' => $this->faker->word,
        'seats' => $this->faker->randomDigitNotNull,
        'price' => $this->faker->randomDigitNotNull,
        'currency' => $this->faker->word,
        'transmission_id' => $this->faker->word,
        'fuel_type_id' => $this->faker->word,
        'one_day_caution' => $this->faker->randomDigitNotNull,
        'other_caution' => $this->faker->randomDigitNotNull,
        'location' => $this->faker->word,
        'images' => $this->faker->text,
        'properties' => $this->faker->text,
        'approved' => $this->faker->word,
        'for_sale' => $this->faker->word,
        'on_lease' => $this->faker->word,
        'sold' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
