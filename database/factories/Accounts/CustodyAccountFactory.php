<?php

namespace Database\Factories\Accounts;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accounts\CustodyAccount>
 */
class CustodyAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nickname' => $this->faker->unique()->firstName(),
            'account_identifier' => $this->faker->randomNumber(),
        ];
    }
}
