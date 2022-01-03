<?php

namespace App\Auth\Entity\User;

use Webmozart\Assert\Assert;

class Email
{
    private string $email;

    public function __construct(string $email)
    {
        Assert::notEmpty($email);
        Assert::email($email);
        $this->email = $email;
    }

    public function isEqualTo(self $other)
    {
        return $this->email === $other->email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
