<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends Model
{
    protected $fillable = [
        'time',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getTimeAttribute($value): ?CarbonImmutable
    {
        return $value ? CarbonImmutable::createFromFormat('H:i:s', $value) : null;
    }

    public function bookingHours(): HasMany
    {
        return $this->HasMany(BookingHour::class);
    }
}
