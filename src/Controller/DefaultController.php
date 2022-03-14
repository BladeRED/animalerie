<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    private $productRepository;

    public function __construct(ProductRepository $productRepository){

$this->productRepository = $productRepository;


    }

    #[Route('/', name: 'homepage')]
    public function displayHomePage(): Response
    {
        return $this->render('default/homepage.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('/default', name: 'default')]
    public function index(): Response
    {

        $products = $this->productRepository->findAll();


        return $this->render('default/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('CGV', name: 'CGV')]
    public function displayCGV(): Response
    {
        return $this->render('default/CGV.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('compteclient', name: 'compteclient')]
    public function displaycompteclient(): Response
    {
        return $this->render('default/compteclient.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    #[Route('mentionslegales', name: 'mentionslegales')]
    public function displayMentions(): Response
    {
        return $this->render('default/mentionslegales.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('product/{id}', name:'detail_product')]
    public function getOne(Product $product){

        return $this->render('default/product.html.twig', ['product' =>$product]);

    }
}
