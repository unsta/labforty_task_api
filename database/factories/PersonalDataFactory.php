<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Helpers\EgnHelper;
use App\Models\BookingHour;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookingHour>
 */
class PersonalDataFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 2),
            'egn_encrypted' => EgnHelper::encrypt('3208080983'),
            'egn_hash' => EgnHelper::hash('3208080983'),
            'egn_index' => hash('sha256', '3208080983'),
            'created_at' => CarbonImmutable::now(),
        ];
    }
}
