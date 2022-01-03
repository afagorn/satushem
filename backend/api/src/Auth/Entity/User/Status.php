<?php

namespace App\Auth\Entity\User;

class Status
{
    private const WAIT = 'wait';
    private const ACTIVE = 'active';

    private function __construct(private string $status)
    {
    }

    public static function wait(): Status
    {
        return new self(self::WAIT);
    }

    public static function active(): Status
    {
        return new self(self::ACTIVE);
    }

    public function isWait(): bool
    {
        return $this->status === self::WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::ACTIVE;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
