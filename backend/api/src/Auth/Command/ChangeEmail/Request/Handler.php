<?php

declare(strict_types=1);

namespace App\Auth\Command\ChangeEmail\Request;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\Id;
use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\ChangeEmailSender;
use App\Auth\Service\Tokenizer;
use App\Flusher;
use DateTimeImmutable;
use DomainException;

class Handler
{
    public function __construct(
        private UserRepository $repository,
        private Flusher $flusher,
        private Tokenizer $tokenizer,
        private ChangeEmailSender $sender
    ) {
    }

    public function handle(Command $command)
    {
        if($this->repository->hasByEmail($email = new Email($command->email))) {
            throw new DomainException('This email already in use');
        }

        $user = $this->repository->getById(new Id($command->id));

        $user->requestChangeEmail(
            $token = $this->tokenizer->generate(new DateTimeImmutable()),
            $email
        );

        $this->flusher->flush();
        $this->sender->send($email, $token);
    }
}
