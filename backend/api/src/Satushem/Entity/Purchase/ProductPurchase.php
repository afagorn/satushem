<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Purchase;

use App\Satushem\Entity\Price\Price;

class ProductPurchase
{
    private Price $price;
    private Amount $amount;

    public function __construct(
        Price $productSupplier,
        Amount $amount
    ) {
        $this->price = $productSupplier;
        $this->amount = $amount;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }
}
