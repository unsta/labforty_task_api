<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Exceptions\Api\V1\BookingHourCreationException;
use App\DTOs\StoreBookingHours\{BookingHourDto, PersonalDataDto, TimeSlotDto};
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Interfaces\Api\V1\PersonalDataRepositoryInterface;
use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\{DB, Log};

readonly class StoreBookingHourService
{
    public function __construct(
        public BookingHourRepositoryInterface $bookingHourRepository,
        public PersonalDataRepositoryInterface $personalDataRepository,
        public TimeSlotRepositoryInterface $timeSlotRepository,
    ) {
    }

    public function storeBookingHour(
        BookingHourDto $bookingHourDto,
        PersonalDataDto $personalDataDto,
        TimeSlotDto $timeSlotDto
    ): void {
        try {
            DB::transaction(function () use ($bookingHourDto, $personalDataDto, $timeSlotDto) {
                $this->bookingHourRepository->store($bookingHourDto, $timeSlotDto->timeSlotId);
                $this->personalDataRepository->store($personalDataDto);
            });
        } catch (Exception $e) {
            Log::error(sprintf('Booking Hour creation failed: %s', $e->getMessage()));
            throw new BookingHourCreationException($e->getMessage());
        }
    }
}
