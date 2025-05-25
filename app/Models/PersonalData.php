<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalData extends Model
{
    protected $fillable = [
        'user_id',
        'egn_encrypted',
        'egn_hash',
    ];

    protected $hidden = [
        'egn_encrypted',
        'egn_hash',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
