<?php

declare(strict_types=1);

namespace App\Auth\Entity\User;

use Webmozart\Assert\Assert;

class Role
{
    public const ADMIN = 'admin';
    public const USER = 'user';

    private string $value;

    public function __construct(string $role)
    {
        Assert::oneOf($role, [
            self::ADMIN,
            self::USER
        ]);

        $this->value = $role;
    }

    public function isAdmin(): bool
    {
        return $this->value === self::ADMIN;
    }

    public function isUser(): bool
    {
        return $this->value === self::USER;
    }

    public static function Admin(): self
    {
        return new self(self::ADMIN);
    }

    public static function User(): self
    {
        return new self(self::USER);
    }

    public function isEqualTo(self $role): bool
    {
        return $this->value === $role->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
