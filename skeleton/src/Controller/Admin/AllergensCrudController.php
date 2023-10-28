<?php

namespace App\Controller\Admin;

use App\Entity\Allergens;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class AllergensCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Allergens::class;
    }
    public function configureCrud(Crud $crude): Crud
    {
        return $crude
        ->setEntityLabelInPlural('Allergènes')
        ->setEntityLabelInSingular('Allergène')
        ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
        ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un %entity_label_singular%')
        ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
        ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du %entity_label_singular%');
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
