<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\TimeSlot;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        $startTime = CarbonImmutable::createFromTime(9);
        $endTime = CarbonImmutable::createFromTime(18);

        $period = CarbonPeriod::create($startTime, '30 minutes', $endTime);

        foreach ($period as $time) {
            TimeSlot::create([
                'time' => $time->format('H:i'),
                'is_active' => 1,
            ]);
        }
    }
}
