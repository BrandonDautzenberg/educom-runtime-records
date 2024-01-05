<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddProductForm\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddProductController extends AbstractController
{
    private $ProductRepository;

    #[Route('/addProduct', name: 'stock')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $product->setTitle('Rust in Peace');
        $product->setArtist('Megadeth');
        $product->setPrice('22');
        $product->setGenre('Thrash Metal');
        $product->setCover('https://m.media-amazon.com/images/I/81KM0plGIpL._AC_SL1300_.jpg');
        $product->setDescription('Lorem Ipsum');
        $product->setFormat('LP');
        $product->setInventory('100');


        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('addProduct.html.twig', [
            'form' => $form,
        ]);
    }
}