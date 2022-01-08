<?php

declare(strict_types=1);

namespace App\Satushem\Command\Purchase\Create;

class Command
{
    public string $title = '';
    public string $description = '';
    public array $data = [];
    /*
    [
        supplier_id1 => [
            product_id1 => amount,
            product_id2 => amount
        ],
        supplier_id2 => [
            product_id1 => amount
            product_id3 => amount
        ]
    ]
    */
}
