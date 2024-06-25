<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

class ProductCrudController extends AbstractCrudController
{
    public const ACTION_DUCPLICATE = 'duplicateProduct';
    public const PRODUCT_BASE_PATH = '/uploads/images/product/';
    public const PRODUCT_UPLOAD_DIR = 'public/uploads/images/product';

    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUCPLICATE)
            ->linkToCrudAction('duplicateProduct');

        return $actions
            ->add(Crud::PAGE_EDIT, $duplicate);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Nom'),
            MoneyField::new('Prix')->setCurrency('EUR'),
            ImageField::new('Image')
                ->setBasePath(self::PRODUCT_BASE_PATH)
                ->setUploadDir(self::PRODUCT_UPLOAD_DIR),
            AssociationField::new('categorie'),
            DateTimeField::new('misAJourLe')->hideOnForm(),
            DateTimeField::new('CreeLe')->hideOnForm(),
        ];
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        // dd($entityInstance);
        if (!$entityInstance instanceof Produit) return;

        $entityInstance->setMisAJourLe(new \DateTimeImmutable);
        // dd($entityInstance);
        parent::updateEntity($em, $entityInstance); //appel de la méthode parent AbstractController
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        // dd($entityInstance);
        if (!$entityInstance instanceof Produit) return;

        $entityInstance->setCreeLe(new \DateTimeImmutable);
        // dd($entityInstance);
        parent::persistEntity($em, $entityInstance); //appel de la méthode parent AbstractController
    }

    public function duplicateProduct(
        AdminContext $context,
        EntityManagerInterface $em,
        AdminUrlGenerator $adminUrlGenerator
    ): Response {
        // dd($context);
        /** @var Produit $produit */
        $product = $context->getEntity()->getInstance();

        $duplicateProduct = clone $produit;

        parent::persistEntity($em, $duplicateProduct);

        $url = $adminUrlGenerator->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicateProduct->getId())
            ->generateUrl();

        return $this->redirect($url);
    }
}
