<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1\ListBookingHours;

use App\Enums\NotificationType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingHourResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $notificationEnums = NotificationType::fromBitmask($this->notification_types);

        return [
            'booking_date' => $this->booking_date?->format('Y-m-d'),
            'description' => $this->description,
            'notification_types' => array_map(fn($type) => [
                'value' => $type->value,
                'label' => $type->label(),
            ], $notificationEnums),
            'status'  => $this->status->value,
            'time_slot' => $this->whenLoaded('timeSlot', fn () => new TimeSlotResource($this->timeSlot)),
            'user' => $this->whenLoaded('user', fn () => new UserResource($this->user)),
        ];
    }
}
