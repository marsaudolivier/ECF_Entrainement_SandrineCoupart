<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Contacts')
        ->setEntityLabelInSingular('Contact')
        ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
        ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un %entity_label_singular%')
        ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
        ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du %entity_label_singular%');
    }
        

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex(),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('phone'),
            TextField::new('mail'),
            TextField::new('request'),
        ];
    }
}
