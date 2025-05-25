<?php

declare(strict_types=1);

namespace App\Http\Interfaces\Api\V1;

use App\Models\User;

interface LoginRepositoryInterface
{
    public function getUser(string $email): ?User;
}
