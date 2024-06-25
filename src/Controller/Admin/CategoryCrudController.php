<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Nom'),
            DateTimeField::new('misAJourLe')->hideOnForm(),
            DateTimeField::new('creeLE')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        // dd($entityInstance);
        if (!$entityInstance instanceof Categorie) return;

        $entityInstance->setCreeLE(new \DateTimeImmutable);
        // dd($entityInstance);
        parent::persistEntity($em, $entityInstance); //appel de la méthode parent AbstractController
    }

    public function deleteEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Categorie) return;

        foreach ($entityInstance->getProduits() as $product) {
            $em->remove($product);
        }

        parent::deleteEntity($em, $entityInstance);
    }
}
