<?php

declare(strict_types=1);

namespace App\Auth\Command\ChangeEmail\Confirm;

use App\Auth\Entity\User\UserRepository;
use App\Flusher;
use DateTimeImmutable;
use DomainException;

class Handler
{
    public function __construct(
        private UserRepository $repository,
        private Flusher $flusher
    ){
    }

    public function handle(Command $command)
    {
        if(is_null($user = $this->repository->findByChangeEmailToken($command->token))) {
            throw new DomainException('Invalid token');
        }

        $user->ConfirmChangeEmail($command->token, new DateTimeImmutable());
        $this->flusher->flush();
    }
}
