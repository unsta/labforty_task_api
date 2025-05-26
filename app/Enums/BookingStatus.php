<?php

declare(strict_types=1);

namespace App\Enums;

enum BookingStatus: string
{
    case CONFIRMED = 'confirmed';
    case CANCELED = 'canceled';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match($this) {
            self::CONFIRMED => 'Confirmed',
            self::CANCELED => 'Canceled',
        };
    }
}
