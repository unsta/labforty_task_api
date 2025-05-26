<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\DTOs\{BookingHourDto, PersonalDataDto, TimeSlotDto};
use App\Http\Exceptions\Api\V1\StoreBookingHourException;
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

    /**
     * @throws StoreBookingHourException
     */
    public function storeBookingHour(
        BookingHourDto $bookingHourDto,
        PersonalDataDto $personalDataDto,
        TimeSlotDto $timeSlotDto
    ): void {
        $timeSlot = $this->timeSlotRepository->findOneByTimeAndStatus($timeSlotDto->time);

        if (null === $timeSlot) {
            throw new StoreBookingHourException();
        }

        try {
            DB::transaction(function () use ($bookingHourDto, $personalDataDto, $timeSlot) {
                $this->bookingHourRepository->store($bookingHourDto, $timeSlot->id);
                $this->personalDataRepository->store($personalDataDto);
            });
        } catch (Exception $e) {
            Log::error('Booking Hour creation failed: ' . $e->getMessage());
        }
    }
}
