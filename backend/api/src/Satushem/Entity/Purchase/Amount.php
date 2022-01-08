<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Purchase;

use Webmozart\Assert\Assert;

class Amount
{
    private int $value;

    public function __construct(int $value)
    {
        Assert::positiveInteger($value);
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
