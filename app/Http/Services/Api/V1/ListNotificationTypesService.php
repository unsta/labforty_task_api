<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Enums\NotificationType;
use Illuminate\Support\Collection;

readonly class ListNotificationTypesService
{
    public function getNotificationTypes(): Collection
    {
        return collect(NotificationType::cases())
            ->map(fn($type) => [
                'label' => $type->label(),
                'value' => $type->value,
            ])
            ->values();
    }
}
