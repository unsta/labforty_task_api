<?php

declare(strict_types=1);

namespace App\Http\Repositories\Api\V1;

use App\DTOs\ListBookedHours\BookingHourDto as ListBookedHoursDto;
use App\DTOs\StoreBookingHours\BookingHourDto;
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;
use App\Http\Resources\Api\V1\ListBookedHours\BookingHourResource;
use App\Models\BookingHour;
use Illuminate\Http\Resources\Json\ResourceCollection;

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

    public function getAllBookings(ListBookedHoursDto $dto, ?string $egn): ResourceCollection
    {
        $users = BookingHour::query()
            ->dateFrom($dto->dateFrom)
            ->dateTo($dto->dateTo)
            ->booked()
            ->when($egn, fn($q) => $q->whereHas('user.personalData', fn($q) => $q->egn($egn)))
            ->with(['user.personalData', 'timeSlot'])
            ->paginate(15);

        return BookingHourResource::collection($users);
    }
}
