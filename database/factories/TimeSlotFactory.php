<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BookingHour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookingHour>
 */
class TimeSlotFactory extends Factory
{
    public function definition(): array
    {
        return [
            'time' => '09:30',
            'is_active' => 1,
        ];
    }
}
