<?php

declare(strict_types=1);

namespace App\Satushem\Command\Purchase\Create;

use App\Satushem\Entity\Price\PriceRepository;
use App\Satushem\Entity\Purchase\Id;
use App\Satushem\Entity\Purchase\ProductPurchase;
use App\Satushem\Entity\Purchase\Purchase;
use App\Satushem\Entity\Purchase\Title;
use ArrayObject;

class Handle
{
    public function __construct(
        private PriceRepository $priceRepository
    ) {
    }

    public function handle(Command $command)
    {
        $this->priceRepository->getBySupplierAndProductId();

        $productPurchaseCollection = new ArrayObject();

        $productPurchase = new ProductPurchase(

        );

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

        $purchase = new Purchase(
            Id::generation(),
            new Title($command->title),

        );
    }
}
