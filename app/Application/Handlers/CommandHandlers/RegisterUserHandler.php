<?php

namespace App\Application\Handlers\CommandHandlers;

use App\Application\Commands\RegisterUserCommand;
use App\Application\Exceptions\ValidationException;
use App\Application\Handlers\Handler;
use App\Domain\Repositories\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

final readonly class RegisterUserHandler extends Handler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
    )
    {
    }

    /**
     * @throws ValidationException
     */
    public function handle(RegisterUserCommand $command): array
    {
        $this->validate(...$command->getInfo());

        $user = $this->userRepository->create(
            email: $command->email,
            password: $command->password
        );

        $token = $this->userRepository->createToken($user);

        return qck_response(
            ['token' => $token],
            'Successfully created user',
            Response::HTTP_CREATED
        );
    }
}
