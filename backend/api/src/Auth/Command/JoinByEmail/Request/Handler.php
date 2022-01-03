<?php

declare(strict_types=1);

namespace App\Auth\Command\JoinByEmail\Request;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\Status;
use App\Auth\Entity\User\User;
use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\JoinConfirmationSender;
use App\Auth\Service\PasswordHasher;
use App\Auth\Service\Tokenizer;
use DateTimeImmutable;
use DomainException;
use App\Flusher;

class Handler
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordHasher $hasher,
        private Tokenizer $tokenizer,
        private JoinConfirmationSender $sender,
        private Flusher $flusher
    ) {
    }

    public function handle(Command $command): void
    {
        $email = new Email($command->email);

        if($this->userRepository->hasByEmail($email)) {
            throw new DomainException('This email already exist');
        }

        $user = User::requestJoinByEmail(
            Id::generation(),
            $email,
            $this->hasher->hash($command->password),
            new DateTimeImmutable(),
            $token = $this->tokenizer->generate(new DateTimeImmutable())
        );

        $this->userRepository->add($user);

        $this->flusher->flush();

        $this->sender->send($email, $token);
    }
}