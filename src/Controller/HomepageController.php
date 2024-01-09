<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Product;
use App\Repository\ProductRepository;


class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $em) : Response
    {
        $rep = $em->getRepository(Product::class);
        $data = $rep->getAllProducts();
        $randomData = $data;
        shuffle($randomData);

        return $this->render('index.html.twig', [
            'controller_name' => 'HomepageController', 'products' => $data,
            'randomProduct' => $randomData[0],
        ]);
    }

    #[Route('/browse/{slug}', name: 'detail')]    
    public function showDetailPage(EntityManagerInterface $em, string $slug): Response

    {
        $rep = $em->getRepository(Product::class);
        return $this->render('detail.html.twig', [
            'controller_name' => 'HomepageController',
            'product' => $rep->findOneBy(array('title' => $slug))
        ]);
    }

    #[Route('/buy', name: 'shoppingcart')]
    public function showShoppingCart(): Response 
    {
        return $this->render('shoppingCart.html.twig', [
            'controller_name' => 'HomepageController'
        ]);
    }

//     #[Route('/addProduct', name: 'stock')]
//     public function showForm(): Response 
//     {
        

//         return $this->render('addProduct.html.twig', [
//             'controller_name' => 'HomepageController',
//         ]);
//     }
// }
}