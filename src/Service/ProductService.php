<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;

use App\Repository\ProductRepository;

class ProductService {
    private $ProductRepository;
    

    public function __construct(EntityManagerInterface $em) {
        $this->ProductRepository = $em->getRepository(Product::class);
    }

    public function fetchProduct($id) {
        return($this->ProductRepository->fetchProduct($id));
    }
}

