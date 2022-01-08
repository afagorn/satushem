<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Supplier;

class Supplier
{
    private Id $id;
    private Title $title;
    private Address $address;

    public function __construct(
        Id $id,
        Title $title,
        Address $address
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->address = $address;
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
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }
}
