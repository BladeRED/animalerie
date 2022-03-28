<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{
    private $categoryRepository;

    public function __construct( CategoryRepository $categoryRepository, ProductRepository $productRepository){

        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;

    }
    #[Route('/navbar', name: '_navbar')]
    public function index(): Response
    {
        $categories = $this->categoryRepository->findAll();

        return $this->render('navbar/header.html.twig', [
            'categories' => $categories,
            'controller_name' => 'NavbarController',
        ]);

    }

    #[Route('category/{id}', name: 'detail_categ')]
    public function getOneCateg(Category $category, Product $product)
    {

        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        return $this->render('navbar/categorie.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'category' => $category,
            'controller_name' => 'DefaultController',
        ]);
    }
}
