<?php

namespace Database\Factories;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_name' =>  $this->faker->name,
            'address1' =>  $this->faker->address,
            'address2' => $this->faker->address,
            'city' => $this->faker->city,
            'state' => $this->faker->city,
            'country' => $this->faker->country,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'phone_no1' => $this->faker->phoneNumber,
            'phone_no2' => $this->faker->phoneNumber,
            'zip' => $this->faker->randomNumber(5),
            'start_validity' => Carbon::now(),
            'end_validity' => Carbon::now()->addDays(15),
            'status' => Client::STATUS_ACTIVE,
        ];
    }
}
