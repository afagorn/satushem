<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Product;

use Webmozart\Assert\Assert;

class Title
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
