<?php

declare(strict_types=1);

namespace App\DTOs\ListBookedHours;

readonly class BookingHourDto
{
    public function __construct(
        public ?string $dateFrom,
        public ?string $dateTo,
        public int $userId,
    ) {}
}
