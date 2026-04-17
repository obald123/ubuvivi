<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_type_id' => $this->faker->word,
        'package_id' => $this->faker->word,
        'price' => $this->faker->text,
        'departure_address' => $this->faker->word,
        'arrival_address' => $this->faker->word,
        'departure_time' => $this->faker->word,
        'arrival_time' => $this->faker->word,
        'approved' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
