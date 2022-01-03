<?php

declare(strict_types=1);

namespace App\Auth\Entity\User;

use DateTimeImmutable;
use DomainException;
use Webmozart\Assert\Assert;

class Token
{
    private string $token;
    private DateTimeImmutable $expires;

    public function __construct(string $token, DateTimeImmutable $expires)
    {
        Assert::uuid($token);
        $this->token = $token;
        $this->expires = $expires;
    }

    public function validate(string $token, DateTimeImmutable $date)
    {
        if (!$this->isEqualTo($token)) {
            throw new DomainException('Token is invalid');
        }

        if($this->isExpiredTo($date)) {
            throw new DomainException('Token is expired');
        }
    }

    private function isEqualTo(string $token): bool
    {
        return $this->token === $token;
    }

    public function isExpiredTo(DateTimeImmutable $date): bool
    {
        return $this->getExpires() > $date;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpires(): DateTimeImmutable
    {
        return $this->expires;
    }
}
