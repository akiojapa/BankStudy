<?php

namespace Database\Factories;

use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->randomFloat(2, 1, 1000),
            'payment_method' => $this->faker->randomElement(PaymentMethodEnum::cases()),
            'account_number' => $this->faker->numberBetween(100000, 999999),
        ];
    }
}
