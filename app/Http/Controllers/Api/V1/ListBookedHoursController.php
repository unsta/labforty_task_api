<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ListBookedHoursRequest;
use App\Http\Services\Api\V1\ListBookedHoursService;
use App\Mappers\ListBookedHoursMapper;
use Illuminate\Http\Resources\Json\ResourceCollection;

readonly class ListBookedHoursController
{
    public function __construct(public ListBookedHoursService $service)
    {
    }

    public function __invoke(ListBookedHoursRequest $request): ResourceCollection
    {
        [$bookingHourDto, $personalDataDto] = ListBookedHoursMapper::fromRequest($request);

        return $this->service->listBookedHours($bookingHourDto, $personalDataDto);
    }
}
