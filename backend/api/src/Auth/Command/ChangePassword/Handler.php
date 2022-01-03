<?php

declare(strict_types=1);

namespace App\Auth\Command\ChangePassword;

use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\PasswordHasher;
use App\Flusher;

class Handler
{
    public function __construct(
        private UserRepository $repository,
        private Flusher $flusher,
        private PasswordHasher $hasher
    ) {
    }

    public function handle(Command $command)
    {
        $user = $this->repository->getById(new Id($command->id));

        $user->changePassword(
            $command->current,
            $command->new,
            $this->hasher
        );

        $this->flusher->flush();
    }
}
