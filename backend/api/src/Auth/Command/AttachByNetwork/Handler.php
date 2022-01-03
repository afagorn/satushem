<?php

declare(strict_types=1);

namespace App\Auth\Command\AttachByNetwork;

use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\NetworkIdentity;
use App\Auth\Entity\User\UserRepository;
use App\Flusher;
use DomainException;

class Handler
{
    public function __construct(
        private UserRepository $repository,
        private Flusher        $flusher
    ) {
    }

    public function handle(Command $command): void
    {
        $network = new NetworkIdentity($command->network, $command->identity);
        if($this->repository->hasByNetwork($network)) {
            throw new DomainException('This network already in use');
        }

        $user = $this->repository->getById(new Id($command->id));

        $user->attachNetwork($network);

        $this->flusher->flush();
    }
}
