<?php

namespace App\Satushem\Entity\Supplier;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class Id
{
    private string $id;

    public function __construct(string $id)
    {
        Assert::uuid($id);
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public static function generation(): Id
    {
        return new self(Uuid::uuid4()->toString());
    }
}
