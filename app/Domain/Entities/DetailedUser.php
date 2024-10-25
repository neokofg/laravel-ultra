<?php

namespace App\Domain\Entities;

class DetailedUser extends User
{
    public readonly string $id;
    public readonly string $name;
    public readonly string $username;

    public function __construct(string $id, string $name, $username, string $email)
    {
        parent::__construct($email);

        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
    }
}
