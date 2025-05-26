<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingHour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_date',
        'time_slot_id',
        'user_id',
        'description',
        'notification_types',
        'status',
    ];

    protected $casts = [
      'booking_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class);
    }
}
