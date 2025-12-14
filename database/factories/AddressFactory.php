<?php

namespace Modules\Address\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\User\Models\User;

class AddressFactory extends Factory
{
    protected $model = \Modules\Address\Models\Address::class;

    public function definition()
    {        
        return [
            'id' => Str::uuid(),
            'title' => $this->faker->randomElement(['Billing', 'Shipping']),
            'type' => function (array $attributes) {
                return strtolower($attributes['title']);
            },
            'default' => 0,
            'address' => json_encode([
                'zip' => $this->faker->postcode(),
                'city' => $this->faker->city(),
                'state' => $this->faker->stateAbbr(),
                'country' => $this->faker->country(),
                'street_address' => $this->faker->streetAddress(),
            ]),
            'location' => null,
            'customer_id' => User::factory(),
            'created_at' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'updated_at' => now(),
        ];
    }
}