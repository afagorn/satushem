<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Purchase;

use ArrayObject;

class Purchase
{
    private Id $id;
    private Title $title;
    private string $description = '';
    private ArrayObject $productPurchaseCollection;

    public function __construct(
        Id $id,
        Title $title,
        ArrayObject $productPurchaseCollection,
        string $description = ''
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->productPurchaseCollection = $productPurchaseCollection;
        $this->description = $description;
    }

    /**
     * @return ProductPurchase[]
     */
    public function getProductPurchaseCollection(): array
    {
        return $this->productPurchaseCollection->getArrayCopy();
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
