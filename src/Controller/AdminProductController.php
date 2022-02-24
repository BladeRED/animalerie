<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/product')]
class AdminProductController extends AbstractController
{
    #[Route('/', name: 'admin_product_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('admin/product_crud/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $pictureProduct = $form->get('picture')->getData();
            $originalFileName = pathinfo($pictureProduct->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFileName= $slugger->slug($originalFileName);

            $newFileName = $safeFileName.'-'.uniqid().'.'.$pictureProduct->guessExtension();

            $pictureProduct->move(

                $this->getParameter('product_picture'),
                $newFileName
            );

            $product->setPicture($newFileName);

            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product_crud/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_product_show', methods: ['GET'])]
    public function show(Product $product): Response
    {
        return $this->render('admin/product_crud/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $pictureProduct = $form->get('picture')->getData();
            $originalFileName = pathinfo($pictureProduct->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFileName= $slugger->slug($originalFileName);

            $newFileName = $safeFileName.'-'.uniqid().'.'.$pictureProduct->guessExtension();

            $pictureProduct->move(

                $this->getParameter('product_picture'),
                $newFileName
            );

            $product->setPicture($newFileName);

            $entityManager->flush();

            return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/product_crud/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_product_index', [], Response::HTTP_SEE_OTHER);
    }
}
