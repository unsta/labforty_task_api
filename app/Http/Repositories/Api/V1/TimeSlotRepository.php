<?php

declare(strict_types=1);

namespace App\Http\Repositories\Api\V1;

use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use App\Models\TimeSlot;

class TimeSlotRepository implements TimeSlotRepositoryInterface
{
    public function findOneByTimeAndStatus(string $time, int $isActive = 1): ?TimeSlot
    {
        return TimeSlot::where(['time' => $time, 'is_active' => $isActive])->first();
    }
}
