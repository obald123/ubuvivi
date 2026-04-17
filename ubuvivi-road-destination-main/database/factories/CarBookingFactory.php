<?php

namespace Database\Factories;

use App\Models\CarBooking;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarBookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarBooking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'names' => $this->faker->word,
        'email' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'delivery_location' => $this->faker->word,
        'delivery_date' => $this->faker->word,
        'delivery_time' => $this->faker->word,
        'number_of_days' => $this->faker->word,
        'message' => $this->faker->text,
        'price' => $this->faker->word,
        'approved' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
