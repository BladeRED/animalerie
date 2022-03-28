<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductOrder;
use App\Entity\Produit;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    private $productRepository;
    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;

    }

    #[Route('/{id}', name: 'add', requirements: ['id' => '\d+' ])]
    public function addPanier(Product $product, Request $request): Response
    {

        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        $productOrder = new ProductOrder();
        $productOrder->setProduct($product);
        $productOrder->setQuantity(1);

        $session =$request->getSession();

        // tableau vide qui représente panier //
        $panier =[];

        // si j'ai déjà un panier en session, alors je le récupère //
        if($session->has("panier")){

            $panier = $session->get("panier");

        }

        $exist = false;

        // Vérifie si on a déjà ce produit dans le panier
        foreach ($panier as $productOrderElem){
            if($productOrderElem->getProduct()->getId() == $product->getId()){
                $exist = true;
                $productOrderElem->setQuantity($productOrderElem->getQuantity() + 1);
            }
        }

        if(!$exist){

            $panier[] = $productOrder;
        }
        // MAJ du panier //
        $session->set("panier", $panier);
        // redirection //
        return $this->redirectToRoute('panier_displayPanier');
    }

    #[Route('/remove-panier/{id}', name: 'remove_panier')]
    public function removePanier(Product $product, Request $request){

        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        $session = $request->getSession();
        $panier = $session->get('panier');

        $delete = null;
        foreach ($panier as $key=>$productOrder){
            if($product->getId() == $productOrder->getProduct()->getId()){
                $delete = $key;
            }
        }

        unset($panier[$delete]);

        $session->set('panier', $panier);


        return $this->redirectToRoute('panier_displayPanier');
    }

    #[Route('/{operator}/{id}', 'addOrRemoveOne')]
    public function incrementPanierProduct(Product $product, Request $request, $operator){

        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        $session = $request->getSession();
        $panier = $session->get('panier');

        foreach ($panier as $orderProduct){
            if($orderProduct->getProduct()->getId() == $product->getId()){
                if($operator == 'plus'){
                    $orderProduct->setQuantity($orderProduct->getQuantity()+1);
                } elseif ($operator == 'minus'){
                    $orderProduct->setQuantity($orderProduct->getQuantity()-1);
                }

            }
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier_displayPanier');
    }


    #[Route('/', name: 'displayPanier')]
    public function index(Request $request): Response
    {
        $products = $this->productRepository->findAll();
        $categories = $this->categoryRepository->findAll();
        $panier= $request->getSession()->get("panier");


        return $this->render('panier/index.html.twig', [
            'categories' => $categories,
            'panier' => $panier,
        ]);
    }
}
