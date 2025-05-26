<?php

declare(strict_types=1);

namespace App\Http\Interfaces\Api\V1;

use App\DTOs\BookingHourDto;

interface BookingHourRepositoryInterface
{
    public function store(BookingHourDto $dto, int $timeSlotId): void;
}
