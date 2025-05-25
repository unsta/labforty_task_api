<?php

declare(strict_types=1);

namespace App\Http\Repositories\Api\V1;

use App\Http\Interfaces\Api\V1\LoginRepositoryInterface;
use App\Models\User;

class LoginRepository implements LoginRepositoryInterface
{
    public function getUser(string $email, string $password): ?User
    {
        return User::where('email', $email)->first();
    }
}
