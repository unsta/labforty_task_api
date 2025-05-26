<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTOs\ListBookedHours\{BookingHourDto, PersonalDataDto};
use App\Http\Requests\Api\V1\ListBookingHoursRequest;

readonly class ListBookingHoursMapper
{
    public static function fromRequest(ListBookingHoursRequest $request): array
    {
        $data = $request->validated();

        return [
            new BookingHourDto(
                dateFrom: $data['date_from'] ?? null,
                dateTo: $data['date_to'] ?? null,
                userId: auth()->id(),
            ),
            new PersonalDataDto(
                egn: $data['egn'] ?? null,
                userId: auth()->id(),
            ),
        ];
    }
}
