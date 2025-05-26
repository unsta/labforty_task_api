<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ListBookingHoursRequest;
use App\Http\Services\Api\V1\ListBookingHoursService;
use App\Mappers\ListBookingHoursMapper;
use Illuminate\Http\Resources\Json\ResourceCollection;

readonly class ListBookingHoursController
{
    public function __construct(public ListBookingHoursService $service)
    {
    }

    public function __invoke(ListBookingHoursRequest $request): ResourceCollection
    {
        [$bookingHourDto, $personalDataDto] = ListBookingHoursMapper::fromRequest($request);

        return $this->service->listBookedHours($bookingHourDto, $personalDataDto);
    }
}
