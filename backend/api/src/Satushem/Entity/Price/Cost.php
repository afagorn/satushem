<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Price;

use Webmozart\Assert\Assert;

class Cost
{
    private const CURRENCY_RUBLE = 'ruble';

    private int $amount;

    private function __construct(string $currency, int $amount)
    {
        Assert::oneOf($currency, [
            self::CURRENCY_RUBLE
        ]);
        Assert::positiveInteger($amount);

        $this->amount = $amount;
    }

    public static function Ruble(int $amount): self
    {
        return new self(self::CURRENCY_RUBLE, $amount);
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
