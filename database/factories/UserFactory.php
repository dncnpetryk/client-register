<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->email,
            'password' => Hash::make('password'),
            'phone' => $this->faker->phoneNumber,
            'profile_uri' => $this->faker->imageUrl,
            'last_password_reset' => Carbon::now(),
            'status' => Client::STATUS_ACTIVE,
        ];
    }
}
