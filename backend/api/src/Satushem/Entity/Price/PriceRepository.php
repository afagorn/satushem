<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Price;

use DomainException;

interface PriceRepository
{
    /**
     * @param Id $id
     * @return Price
     * @throws DomainException
     */
    public function getById(Id $id): Price;

    /**
     * @return Price[]
     */
    public function getBySupplierAndProductId(): array;
}
