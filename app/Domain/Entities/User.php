<?php

namespace App\Domain\Entities;

class User
{
    public readonly string $email;

    public function __construct(
        string $email,
    ) {
        $this->email = $email;
    }
}
