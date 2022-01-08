<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Product;

use DomainException;

interface ProductRepository
{
    /**
     * @param Id $id
     * @return Product
     * @throws DomainException
     */
    public function getById(Id $id): Product;
}
