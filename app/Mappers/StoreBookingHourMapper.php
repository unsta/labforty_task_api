<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTOs\StoreBookingHours\{BookingHourDto, PersonalDataDto, TimeSlotDto};
use App\Enums\BookingStatus;
use App\Http\Requests\Api\V1\StoreBookingHourRequest;

readonly class StoreBookingHourMapper
{
    public static function fromRequest(StoreBookingHourRequest $request): array
    {
        $data = $request->validated();

        return [
            new BookingHourDto(
                bookingDate: $data['booking_date'],
                description: $data['description'] ?? null,
                notificationTypes: $data['notification_types'],
                status: BookingStatus::CONFIRMED->value,
                userId: auth()->id(),
            ),
            new PersonalDataDto(
                egn: $data['egn'],
                userId: auth()->id(),
            ),
            new TimeSlotDto(
                time: $data['time'],
            ),
        ];
    }
}
