<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $userId = User::pluck('id')->toArray();
        return [
            'sender_id'=>fake()->randomElement($userId),
            'receiver_id'=>fake()->randomElement($userId),
            'ammount'=>308,
            'type'=>'transfert'
        ];
    }
}
