<?php

namespace Database\Factories;

use App\Models\TourBooking;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourBookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TourBooking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'itinerary_id' => $this->faker->word,
        'names' => $this->faker->word,
        'email' => $this->faker->word,
        'phone_number' => $this->faker->word,
        'date' => $this->faker->word,
        'message' => $this->faker->text,
        'price' => $this->faker->word,
        'approved' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
