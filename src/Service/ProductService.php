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
        return($this->ProductRepository->fetchOptreden($id));
    }

    public function saveProduct($params) {
        $data = [
          "id" => (isset($params["id"]) && $params["id"] != "") ? $params["id"] : null,
          "title" => $params["title"],
          "artist" => $params["artist"],
          "price" => $params["price"],
          "genre" => $params["genre"],
          "cover" => $params["cover"],              
          "description" => $params["description"],
          "format" => $params["format"],
          "state" => $params["state"]
        ];

        $result = $this->ProductRepository->saveProduct($data);
        return($result);
    }
}

