<?php

declare(strict_types=1);

namespace App\Http\Repositories\Api\V1;

use App\Http\Interfaces\Api\V1\TimeSlotRepositoryInterface;
use App\Http\Resources\Api\V1\TimeSlotResource;
use App\Models\TimeSlot;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TimeSlotRepository implements TimeSlotRepositoryInterface
{
    public function findOneByTimeAndStatus(string $time, int $isActive = 1): ?TimeSlot
    {
        return TimeSlot::where(['time' => $time, 'is_active' => $isActive])->first();
    }

    public function getAll(int $isActive = 1): ResourceCollection
    {
        $timeSlots = TimeSlot::where('is_active', $isActive)->get();

        return TimeSlotResource::collection($timeSlots);
    }
}
