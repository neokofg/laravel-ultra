<?php

namespace App\Application\Exceptions;

use Exception;

final class ValidationException extends Exception
{
    private array $errors;

    public function __construct(array $errors, $message = 'Validation failed', $code = 422, Exception $previous = null)
    {
        parent::__construct(__($message), $code, $previous);

        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
