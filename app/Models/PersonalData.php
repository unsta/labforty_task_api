<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalData extends Model
{
    protected $fillable = [
        'user_id',
        'egn_encrypted',
        'egn_hash',
        'egn_index',
    ];

    protected $hidden = [
        'egn_encrypted',
        'egn_hash',
        'egn_index',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function egn(Builder $query, ?string $egn): void
    {
        if ($egn) {
            $query->where('egn_index', hash('sha256', $egn));
        }
    }
}
