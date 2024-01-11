<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\AddProductForm\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
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
}