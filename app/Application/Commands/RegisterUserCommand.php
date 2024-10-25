<?php

namespace App\Application\Commands;

final readonly class RegisterUserCommand extends Command
{
    /**
     * @param string $email
     * @param string $password
     */
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }
}
