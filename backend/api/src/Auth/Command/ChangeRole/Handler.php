<?php

declare(strict_types=1);

namespace App\Auth\Command\ChangeRole;

use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Role;
use App\Auth\Entity\User\UserRepository;
use App\Flusher;

class Handler
{
    public function __construct(
        private UserRepository $repository,
        private Flusher $flusher
    ) {
    }

    public function handle(Command $command)
    {
        $user = $this->repository->getById(new Id($command->id));

        $user->changeRole(new Role($command->role));

        $this->flusher->flush();
    }
}
