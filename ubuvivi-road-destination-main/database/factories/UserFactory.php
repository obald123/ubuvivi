<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'role' => "agent",
            'email_verified_at' => null,
            'password' => Hash::make($this->faker->word),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null
        ];
    }
}
