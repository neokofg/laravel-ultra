<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function create(string $email, string $password): User;
    public function createToken(User $user): string;
}
