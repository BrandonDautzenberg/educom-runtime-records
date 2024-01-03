<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Orders;
use App\Entity\Product;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;

class OrderService {
    private $OrderRepository;

    private $ProductRepository;

    public function __construct(EntityManagerInterface $em) {
        $this->ProductRepository = $em->getRepository(Product::class);
        $this->OrderRepository = $em->getRepository(Orders::class);
    }

    public function fetchProduct($id) {
        return($this->ProductRepository->fetchOptreden($id));
    }

    public function fetchOrder($id) {
        return($this->OrderRepository->fetchOrder($id));
    }

    public function placeOrder($params) {
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