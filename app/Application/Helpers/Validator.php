<?php

namespace App\Application\Helpers;

use App\Application\Exceptions\ValidationException;
use App\Application\Services\ValidationService;

final readonly class Validator
{
    /**
     * @throws ValidationException
     */
    public function validate(ValidationService $validationService, array $data, array $keys): void
    {
        $validationService->validate($data, $keys);
    }
}
