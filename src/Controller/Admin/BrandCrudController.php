<?php

namespace App\Controller\Admin;

use App\Entity\Marque;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

class BrandCrudController extends AbstractCrudController
{

    public const PRODUCT_BASE_PATH = '/uploads/images/marque/';
    public const PRODUCT_UPLOAD_DIR = 'public/uploads/images/marque';

    public static function getEntityFqcn(): string
    {
        return Marque::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('Nom'),
            ImageField::new('Image')
                ->setBasePath(self::PRODUCT_BASE_PATH)
                ->setUploadDir(self::PRODUCT_UPLOAD_DIR),
        ];
    }

    // public function deleteEntity(EntityManagerInterface $em, $entityInstance): void
    // {
    //     if (!$entityInstance instanceof Marque) return;

    //     foreach ($entityInstance->getProduits() as $product) {
    //         $em->remove($product);
    //     }

    //     parent::deleteEntity($em, $entityInstance);
    // }
    public function deleteBrandById(EntityManagerInterface $em, int $brandId): bool
    {
        $brand = $em->getRepository(Marque::class)->find($brandId);

        if (!$brand) {
            // Optionally, you can throw an exception or return false to indicate the brand was not found
            return false;
        }

        $this->deleteEntity($em, $brand);

        // Assuming deleteEntity handles all operations successfully
        return true;
    }
}
