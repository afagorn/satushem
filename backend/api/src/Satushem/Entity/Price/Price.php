<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Price;

use App\Satushem\Entity\Product\Product;
use App\Satushem\Entity\Supplier\Supplier;

class Price
{
    private Id $id;
    private Product $product;
    private Cost $cost;
    private Supplier $supplier;

    public function __construct(Id $id, Supplier $supplier, Product $product, Cost $cost)
    {
        $this->product = $product;
        $this->cost = $cost;
        $this->supplier = $supplier;
        $this->id = $id;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Supplier
     */
    public function getSupplier(): Supplier
    {
        return $this->supplier;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return Cost
     */
    public function getCost(): Cost
    {
        return $this->cost;
    }
}
