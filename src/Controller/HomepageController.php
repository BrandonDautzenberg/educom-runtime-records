<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Product;
use App\Entity\User;
use App\Form\SearchCriteriaType\SearchCriteriaType;
use Symfony\Component\PropertyAccess\PropertyAccess;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(EntityManagerInterface $em) : Response
    {   
        $currentUser = $this->getUser();

        $repProduct = $em->getRepository(Product::class);
        $data = $repProduct->getAllProducts();
        $randomData = $repProduct->shuffleAllProducts();

        $repUser = $em->getRepository(User::class);
        $currentCriteriaArray = $repUser->searchCriteriaToArray($currentUser);

        return $this->render('index.html.twig', [
            'controller_name' => 'HomepageController', 'products' => $data,
            'randomProduct' => $randomData[0], 
            'currentCriteria' => $currentCriteriaArray,
            'currentUser' => $currentUser,   
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

    #[Route('/accountSettings', name: 'account_settings')]
    public function showAccountSettings(Request $request, EntityManagerInterface $em): Response 
    {
       
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $rep = $em->getRepository(User::class);
        $currentUser = $this->getUser();
        $currentCriteria = $propertyAccessor->getValue($currentUser, 'search_criteria');

        $form = $this->createForm(SearchCriteriaType::class, $currentUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $searchCriteria = $form->getData();
            $rep->saveSearchCriteria($searchCriteria);

            return $this->redirectToRoute('homepage');
        }
        return $this->render('accountSettings.html.twig', [
            'controller_name' => 'HomepageController',
            'form' => $form,
            'currentCriteria' => $currentCriteria,
        ]);
    }

    #[Route('/buy', name: 'shoppingcart')]
    public function showShoppingCart(): Response 
    {
        return $this->render('shoppingCart.html.twig', [
            'controller_name' => 'HomepageController'
        ]);
    }
}