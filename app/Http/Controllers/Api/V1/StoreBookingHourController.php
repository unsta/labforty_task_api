<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\StoreBookingHourRequest;
use App\Http\Services\Api\V1\StoreBookingHourService;
use App\Mappers\StoreBookingHourMapper;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class StoreBookingHourController
{
    public function __construct(public StoreBookingHourService $service)
    {
    }

    public function __invoke(StoreBookingHourRequest $request): JsonResponse
    {
        [$bookingHourDto, $personalDataDto, $timeSlotDto] = StoreBookingHourMapper::fromRequest($request);

        $this->service->storeBookingHour($bookingHourDto, $personalDataDto, $timeSlotDto);

        return response()->json([
            'status' => 'success',
            'message' => sprintf('Booking Hour was successfully created!')
        ], Response::HTTP_CREATED);
    }
}
