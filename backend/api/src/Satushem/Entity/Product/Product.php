<?php

declare(strict_types=1);

namespace App\Satushem\Entity\Product;

use App\Satushem\Entity\Purchase\Id;

class Product
{
    private Id $id;
    private Title $title;
    private string $description = '';
    private Measure $measure;
}
