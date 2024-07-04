<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Promotion;
use App\Entity\Produit;
use App\Entity\Marque;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        //generation d'une URL
        $url = $this->adminUrlGenerator
            ->setController(CategoryCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Loire Pièces Auto');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Website');
        yield MenuItem::linkToUrl('Revenir sur le site', 'fas fa-external-link-alt', 'https://loirepiecesautos.fr/');
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::section('Categories');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter une categorie', 'fas fa-plus', Categorie::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les categories', 'fas fa-eye', Categorie::class)
        ]);


        yield MenuItem::section('Produits', 'fa-solid fa-car');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un produit', 'fas fa-plus', Produit::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les produits', 'fas fa-eye', Produit::class)
        ]);

        yield MenuItem::section('Promotions', 'fa-solid fa-tag');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linktoCrud('Ajouter une promotion', 'fas fa-plus', Promotion::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les promotions', 'fas fa-eye', Promotion::class)
        ]);

        yield MenuItem::section('Marque', 'fa-solid fa-tag');
        yield MenuItem::subMenu('Actions', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter une marque', 'fas fa-plus', Marque::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les marques', 'fas fa-eye', Marque::class)
        ]);
    }
}
