<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TimeSlot extends Model
{
    protected $fillable = [
        'time',
        'is_active',
    ];

    protected $casts = [
        'time' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function bookingHours(): HasMany
    {
        return $this->HasMany(BookingHour::class);
    }
}
