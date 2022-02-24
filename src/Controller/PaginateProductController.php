<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaginateProductController extends AbstractController
{
    #[Route('/paginate/product/{currentPage}/{nbResults}', name: 'paginate_product')]
    public function index(ProductRepository $productRepository, $currentPage, $nbResults): Response
    {
        $nbProducts = $productRepository->count([]);
        $products = $productRepository->findByPagination($currentPage, $nbResults);

        // Pages pleines //

        $nbPages =  $nbProducts/$nbResults;

        if($nbProducts%$nbResults != 0){

            $nbPages= (int) ($nbProducts/$nbResults)+1;

        }


        return $this->render('paginate_product/index.html.twig', [
            'products' => $products,
            'nbPages' => $nbPages,
            'currentPage' => $currentPage,
            'nbResults' => $nbResults
        ]);
    }
}
