<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddProductForm\ProductType;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $ps; 

    public function __construct(ProductService $ps) {
        $this->ps = $ps;      
    }

    #[Route('/addProductToDatabase', name: 'stock')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('addProductToDatabase.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/fetchProduct', name: 'product_save')] 
    public function fetchProduct() {

        $data = $this->ps->fetchProduct(1);
        dd($data);
    }
}