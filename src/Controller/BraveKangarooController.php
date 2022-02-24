<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BraveKangarooController extends AbstractController
{
    #[Route('/brave/kangaroo', name: 'brave_kangaroo')]
    public function index(): Response
    {
        return $this->render('brave_kangaroo/index.html.twig', [
            'controller_name' => 'BraveKangarooController',
        ]);
    }
}
