<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Commands\RegisterUserCommand;
use App\Application\Exceptions\ValidationException;
use App\Application\Handlers\CommandHandlers\RegisterUserHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final readonly class AuthController extends Controller
{
    public function __construct(
        private RegisterUserHandler $registerUserHandler
    )
    {
    }

    /**
     * @throws ValidationException
     */
    public function register(Request $request): JsonResponse
    {
        $command = new RegisterUserCommand(
            email: $request->input('email'),
            password: $request->input('password')
        );

        [$response, $statusCode] = $this->registerUserHandler->handle($command);

        return $this->present($response, $statusCode);
    }
}
