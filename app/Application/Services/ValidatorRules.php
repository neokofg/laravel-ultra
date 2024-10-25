<?php

namespace App\Application\Services;

final readonly class ValidatorRules
{
    public static function getRules(): array
    {
        return [
            'email' =>      ':required|email|string|min:6|max:64',
            'password' =>   ':required|string|min:6|max:64',
            'username' =>   'string|min:2|max:32',
            'name' =>       'string|min:2|max:32',
            'avatar_url' => 'url|string|min:12|max:64|starts_with:https://cdn.indock.ru/',
        ];
    }
}
