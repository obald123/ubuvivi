<?php

namespace Database\Factories;

use App\Models\Itinerary;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItineraryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Itinerary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
        'description' => $this->faker->text,
        'images' => $this->faker->text,
        'highlights' => $this->faker->text,
        'days_description' => $this->faker->text,
        'inclusions' => $this->faker->text,
        'exclusions' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
