<?php

declare(strict_types=1);

namespace App\DTOs\StoreBookingHours;

readonly class TimeSlotDto
{
    public function __construct(
        public int $timeSlotId,
    ) {}
}
