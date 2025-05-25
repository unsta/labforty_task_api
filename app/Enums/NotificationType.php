<?php

declare(strict_types=1);

namespace App\Enums;

enum NotificationType: int
{
    case EMAIL = 1; // 2^0 = 1
    case SMS = 2; // 2^1 = 2

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::EMAIL => 'Email',
            self::SMS => 'SMS',
        };
    }
}
