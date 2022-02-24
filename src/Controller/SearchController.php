<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(Request $request, ProductRepository $pr): Response
    {
        $timeStart = microtime(true);
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        $products = $pr->findAll();

        if ($form->isSubmitted() and $form->isValid()){

            $filters=$form->getData();
            $products=$pr->search($filters);

        }

        $timeEnd= microtime(true);

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'products'=>$products,
            'timeLoad'=>(float) $timeEnd-(float) $timeStart
        ]);
    }
}
