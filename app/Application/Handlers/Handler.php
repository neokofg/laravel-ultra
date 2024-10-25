<?php

namespace App\Application\Handlers;

use App\Application\Exceptions\ValidationException;
use App\Application\Helpers\Validator;
use App\Application\Services\ValidationService;
use Illuminate\Support\Facades\App;

readonly abstract class Handler
{
    /**
     * @param $data
     * @param $keys
     * @return void
     * @throws ValidationException
     */
    public function validate($data, $keys): void
    {
        App::call(function (ValidationService $validationService) use($data, $keys) {
            (new Validator())->validate($validationService, $data, $keys);
        });
    }
}
