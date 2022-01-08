<?php

declare(strict_types=1);

namespace App\Satushem\Entity\User;

class User
{
    private Id $id;

    private function __construct(
        Id $id,
    ) {
        $this->id = $id;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }
}
