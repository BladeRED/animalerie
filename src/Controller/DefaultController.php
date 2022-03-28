<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

    }

    #[Route('/', name: 'homepage')]
    public function displayHomePage(): Response
    {

        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        return $this->render('default/homepage.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/boutique', name: 'boutique')]
    public function displayBoutique(): Response
    {

        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        return $this->render('default/boutique.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/paiement', name: 'paiement')]
    public function displayPaiement(): Response
    {
        $categories = $this->categoryRepository->findAll();
        return $this->render('default/livraisonpaiement.html.twig', [
            'categories' => $categories,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/confirmation', name: 'confirmation')]
    public function displayConfirmation(): Response
    {

        return $this->render('default/confirmation.html.twig', [

            'controller_name' => 'DefaultController',
        ]);
    }


    #[Route('/produit', name: 'produit')]
    public function displayProduit(): Response
    {

        $categories = $this->categoryRepository->findAll();
        return $this->render('default/produit.html.twig', [
            'categories' => $categories,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('CGV', name: 'CGV')]
    public function displayCGV(): Response
    {
        $categories = $this->categoryRepository->findAll();
        return $this->render('default/CGV.html.twig', [
            'categories' => $categories,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('compteclient', name: 'compteclient')]
    public function displaycompteclient(): Response
    {
        $categories = $this->categoryRepository->findAll();
        return $this->render('default/compteclient.html.twig', [
            'categories' => $categories,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('mentionslegales', name: 'mentionslegales')]
    public function displayMentions(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('default/mentionslegales.html.twig', [
            'categories' => $categories,
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('product/{id}', name: 'detail_product')]
    public function getOne(Product $product)
    {

        $categories = $this->categoryRepository->findAll();

        return $this->render('default/produit.html.twig', ['categories' => $categories, 'product' => $product]);

    }

    #[Route('category/{id}', name: 'detail_categ')]
    public function getOneCateg(Category $category)
    {
        $categories = $this->categoryRepository->findAll();
        return $this->render('default/categorie.html.twig', ['categories' => $categories, 'category' => $category]);

    }
}
