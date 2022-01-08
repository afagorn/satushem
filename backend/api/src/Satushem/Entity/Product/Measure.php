<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Product;

class Measure
{
    private const GRAM = 'gram';
    private const PIECE = 'piece';

    private function __construct(private string $value)
    {
    }

    public static function Gram(): self
    {
        return new self(self::GRAM);
    }

    public static function Piece(): self
    {
        return new self(self::PIECE);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
