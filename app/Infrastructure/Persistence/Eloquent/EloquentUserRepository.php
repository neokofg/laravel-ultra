<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(string $email, string $password): User
    {
        // TODO: Implement create() method.
    }

    public function createToken(User $user): string
    {
        // TODO: Implement createToken() method.
    }
}
