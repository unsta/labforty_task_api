<?php

declare(strict_types=1);

namespace App\DTOs;

readonly class BookingHourDto
{
    public function __construct(
        public string $bookingDate,
        public ?string $description,
        public int $notificationTypes,
        public string $status,
        public int $userId,
    ) {}
}
