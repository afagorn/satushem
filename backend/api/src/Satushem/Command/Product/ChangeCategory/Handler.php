<?php

declare(strict_types=1);

namespace App\Satushem\Command\Product\ChangeCategory;

use App\Satushem\Entity\Category\CategoryRepository;
use App\Satushem\Entity\Category\Id as CategoryId;
use App\Satushem\Entity\Product\Id;
use App\Satushem\Entity\Product\ProductRepository;
use DomainException;

class Handler
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private ProductRepository $repository
    ) {
    }

    public function handle(Command $command)
    {
        if(!$this->categoryRepository->hasById(new CategoryId($command->categoryId))) {
            throw new DomainException('This category do not exist');
        }

        $product = $this->repository->getById(new Id($command->id));

    }
}
