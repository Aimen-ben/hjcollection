<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\CategoriesRepository;
use App\Repository\ProductsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/produits', name: 'products_')]
class ProductsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, ProductsRepository $productsRepository, PaginatorInterface $paginator): Response
    {
        $page = $request->query->getInt('page', 1);

        $products = $productsRepository->findProducts($paginator, $page);

        return $this->render('products/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/{slug}', name: 'details')]
    public function details(Products $product): Response
    {
        // dd($product->getName());
       
        return $this->render('products/details.html.twig', compact('product'));
    }
}
