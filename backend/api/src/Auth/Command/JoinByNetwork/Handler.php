<?php

namespace App\Auth\Command\JoinByNetwork;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Network;
use App\Auth\Entity\User\User;
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

    public function handle(Command $command): void
    {
        $network = new Network($command->network, $command->identity);
        $email = new Email($command->email);

        if($this->userRepository->hasByNetwork($network)) {
            throw new DomainException('User with this network already exist');
        }

        if($this->userRepository->hasByEmail($email)) {
            throw new DomainException('User with this email already exist');
        }

        $user = User::requestJoinByNetwork(
            Id::generation(),
            $email,
            new DateTimeImmutable(),
            new Network($command->network, $command->identity)
        );

        $this->userRepository->add($user);

        $this->flusher->flush();
    }
}