<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\BookingStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('booking_hours')->insert([
            [
                'booking_date' => CarbonImmutable::now()->addWeek()->format('Y-m-d'),
                'time_slot_id' => 3,
                'user_id' => 1,
                'notification_types' => 2,
                'status' => BookingStatus::CONFIRMED,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'booking_date' => CarbonImmutable::now()->addDay()->format('Y-m-d'),
                'time_slot_id' => 5,
                'user_id' => 1,
                'notification_types' => 3,
                'status' => BookingStatus::CONFIRMED,
                'created_at' => CarbonImmutable::now(),
            ],
            [
                'booking_date' => CarbonImmutable::now()->addDays(5)->format('Y-m-d'),
                'time_slot_id' => 6,
                'user_id' => 2,
                'notification_types' => 1,
                'status' => BookingStatus::CONFIRMED,
                'created_at' => CarbonImmutable::now(),
            ],
        ]);
    }
}
