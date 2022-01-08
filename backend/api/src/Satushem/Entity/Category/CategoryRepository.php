<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Category;

use DomainException;

interface CategoryRepository
{
    public function hasById(Id $id): bool;

    /**
     * @param Id $id
     * @return Category
     * @throws DomainException
     */
    public function getById(Id $id): Category;
}
