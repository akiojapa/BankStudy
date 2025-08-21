<?php

namespace Database\Factories;

use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transfer>
 */
class TransferFactory extends Factory
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
            'payment_method' => $this->faker->randomElement(PaymentMethodEnum::toArray()),
            'number' => $this->faker->numberBetween(100000, 999999)
        ];
    }
}
