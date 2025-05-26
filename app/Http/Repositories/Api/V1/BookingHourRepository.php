<?php

declare(strict_types=1);

namespace App\Http\Repositories\Api\V1;

use App\DTOs\BookingHourDto;
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Models\BookingHour;

class BookingHourRepository implements BookingHourRepositoryInterface
{
    public function store(BookingHourDto $dto, int $timeSlotId): void
    {
        BookingHour::create([
            'booking_date' => $dto->bookingDate,
            'time_slot_id' => $timeSlotId,
            'user_id' => $dto->userId,
            'description' => $dto->description,
            'notification_types' => $dto->notificationTypes,
            'status' => $dto->status,
        ]);
    }
}
