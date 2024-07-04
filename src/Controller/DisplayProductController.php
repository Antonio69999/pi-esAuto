<?php

namespace App\Controller;

use App\Repository\MarqueRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DisplayProductController extends AbstractController
{
    #[Route('/produits', name: 'produits')]
    public function index(CategorieRepository $cr, MarqueRepository $br): Response
    {
        $categories = $cr->findAll();
        $brands = $br->findAll();

        // dd($categories);

        return $this->render('displayProduct/index.html.twig', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
