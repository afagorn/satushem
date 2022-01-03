<?php

declare(strict_types=1);

namespace App\Auth\Command\ResetPassword\Request;

use App\Auth\Entity\User\Email;
use App\Auth\Entity\User\UserRepository;
use App\Auth\Service\ResetPasswordSender;
use App\Auth\Service\Tokenizer;
use App\Flusher;
use DateTimeImmutable;
use DomainException;

class Handler
{
    public function __construct(
        private UserRepository $userRepository,
        private Flusher $flusher,
        private ResetPasswordSender $sender,
        private Tokenizer $tokenizer
    ) {
    }

    public function handle(Command $command)
    {
        $email = new Email($command->email);
        $date = new DateTimeImmutable();
        $token = $this->tokenizer->generate($date);

        $user = $this->userRepository->getByEmail($email);
        $user->requestResetPassword($token, $date);

        $this->flusher->flush();
        $this->sender->send($email, $token);
    }
}
