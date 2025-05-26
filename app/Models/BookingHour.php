<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\BookingStatus;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
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
        'status' => BookingStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function getBookingDateAttribute($value): ?CarbonImmutable
    {
        return $value ? CarbonImmutable::parse($value) : null;
    }

    #[Scope]
    protected function dateFrom(Builder $query, ?string $dateFrom): void
    {
        if ($dateFrom) {
            $query->where('booking_date', '>=', $dateFrom);
        }
    }

    #[Scope]
    protected function dateTo(Builder $query, ?string $dateTo): void
    {
        if ($dateTo) {
            $query->where('booking_date', '<=', $dateTo);
        }
    }

    #[Scope]
    protected function booked(Builder $query): void
    {
        $query->whereNotNull('user_id');
    }
}
