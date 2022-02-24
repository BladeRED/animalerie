<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/login2', name: 'login2')]
    public function index(): Response
    {
        return $this->render('login/login2.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
