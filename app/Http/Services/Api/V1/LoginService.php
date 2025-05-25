<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1;

use App\Http\Exceptions\Api\V1\LoginException;
use App\Http\Interfaces\Api\V1\LoginRepositoryInterface;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Hash;

readonly class LoginService
{
    public function __construct(public LoginRepositoryInterface $repository)
    {
    }

    public function createToken(string $email, string $password): string
    {
        $user = $this->repository->getUser($email);

        if (null === $user || false === Hash::check($password, $user->password)) {
            throw new LoginException();
        }

        $user->tokens()->delete();

        return $user->createToken('token-name', ['*'], CarbonImmutable::now()->addHour())->plainTextToken;
    }
}
