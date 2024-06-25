<?php

namespace App\Controller\Admin;

use App\Entity\Promotion;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class PromotionCrudController extends AbstractCrudController
{
    public const ACTION_DUCPLICATE = 'duplicatePromotion';
    public const PRODUCT_BASE_PATH = '/uploads/images/promo/';
    public const PRODUCT_UPLOAD_DIR = 'public/uploads/images/promo';

    public static function getEntityFqcn(): string
    {
        return Promotion::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Name'),
            ImageField::new('Image')
                ->setBasePath(self::PRODUCT_BASE_PATH)
                ->setUploadDir(self::PRODUCT_UPLOAD_DIR),
            AssociationField::new('categorie'),
            DateTimeField::new('misAJourLe')->hideOnForm(),
            DateTimeField::new('creeLe')->hideOnForm(),
        ];
    }

    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        // dd($entityInstance);
        if (!$entityInstance instanceof Promotion) return;

        $entityInstance->setMisAJourLe(new \DateTimeImmutable);
        // dd($entityInstance);
        parent::updateEntity($em, $entityInstance); //appel de la méthode parent AbstractController
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        // dd($entityInstance);
        if (!$entityInstance instanceof Promotion) return;

        $entityInstance->setCreeLe(new \DateTimeImmutable);
        // dd($entityInstance);
        parent::persistEntity($em, $entityInstance); //appel de la méthode parent AbstractController
    }
}
