<?php

declare(strict_types=1);

namespace App\Auth\Command\ResetPassword\Reset;

use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\PasswordHasher;
use App\Flusher;
use DateTimeImmutable;
use DomainException;

class Handler
{
    public function __construct(
        private UserRepository $userRepository,
        private Flusher $flusher,
        private PasswordHasher $hasher
    ) {
    }

    public function handle(Command $command)
    {
        if(is_null($user = $this->userRepository->findByResetPasswordToken($command->token))) {
            throw new DomainException('Token is not found');
        }

        $user->resetPassword(
            $command->token,
            new DateTimeImmutable(),
            $command->password,
            $this->hasher
        );

        $this->flusher->flush();
    }
}
