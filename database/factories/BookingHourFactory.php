<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\BookingStatus;
use App\Models\BookingHour;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookingHour>
 */
class BookingHourFactory extends Factory
{
    public function definition(): array
    {
        return [
            'booking_date' => $this->faker->dateTimeBetween(CarbonImmutable::now(), CarbonImmutable::now()->addMonth())->format('Y-m-d'),
            'time_slot_id' => fake()->numberBetween(1, 2),
            'user_id' => fake()->numberBetween(1, 2),
            'notification_types' => fake()->numberBetween(1, 3),
            'status' => BookingStatus::CONFIRMED->value,
        ];
    }
}
