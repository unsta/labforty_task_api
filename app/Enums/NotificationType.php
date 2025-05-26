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

    public static function validBitmaskValues(): array
    {
        return [
            self::EMAIL->value,
            self::SMS->value,
            self::EMAIL->value | self::SMS->value,
        ];
    }

    public static function fromBitmask(int $bitmask): array
    {
        return array_filter(self::cases(), fn ($case) => ($case->value & $bitmask) !== 0);
    }

    public function label(): string
    {
        return match ($this) {
            self::EMAIL => 'Email',
            self::SMS => 'SMS',
        };
    }
}
