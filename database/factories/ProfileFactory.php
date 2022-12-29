<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pin'=>'1234',
            'user_id'=>1,
            'address'=>"yaounde damas",
            'phone'=>fake()->phoneNumber(),
            'birthday'=>fake()->date()
        ];
    }
}
