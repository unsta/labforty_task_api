<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Exceptions\Api\V1\UnauthorizedActionException;
use App\Http\Interfaces\Api\V1\BookingHourRepositoryInterface;

readonly class DestroyBookingHourService
{
    public function __construct(public BookingHourRepositoryInterface $repository)
    {
    }

    public function softDelete(int $id): void
    {
        $booking = $this->repository->find($id);

        if (auth()->id() !== $booking->user_id) {
            throw new UnauthorizedActionException();
        }

        $this->repository->softDelete($booking);
    }
}
