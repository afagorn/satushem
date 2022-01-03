<?php

declare(strict_types=1);

namespace App\Auth\Command\JoinByEmail\Confirm;

use App\Auth\Entity\User\UserRepository;
use App\Flusher;
use DateTimeImmutable;
use DomainException;

class Handler
{
    public function __construct(
        private UserRepository $userRepository,
        private Flusher $flusher
    ) {
    }

    public function handle(Command $command)
    {
        $user = $this->userRepository->findByConfirmToken($command->token);

        if(is_null($user)) {
            throw new DomainException('User with this token not found');
        }

        $user->confirmJoin($command->token, new DateTimeImmutable());

        $this->flusher->flush();
    }
}