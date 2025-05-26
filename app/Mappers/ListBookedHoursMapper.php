<?php

declare(strict_types=1);

namespace App\Mappers;

use App\DTOs\ListBookedHours\{BookingHourDto, PersonalDataDto};
use App\Http\Requests\Api\V1\ListBookedHoursRequest;

readonly class ListBookedHoursMapper
{
    public static function fromRequest(ListBookedHoursRequest $request): array
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
