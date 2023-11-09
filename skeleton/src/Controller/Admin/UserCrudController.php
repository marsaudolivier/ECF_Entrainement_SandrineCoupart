<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;



class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setEntityLabelInPlural('Utilisateurs')
        ->setEntityLabelInSingular('Utilisateur')
        ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
        ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un %entity_label_singular%')
        ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
        ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du %entity_label_singular%');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            IntegerField::new('age'),
            ArrayField::new('roles')->setFormTypeOptions([
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'choices' => [
                        'Aucun' => 'aucun',
                        'Patient' => 'ROLE_PATIENT',
                        'Administrateur' => 'ROLE_ADMIN',
                    ],
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'delete_empty' => true,
            ]),
            AssociationField::new('allergen')
            ->setFormTypeOption('multiple', true)
            ->setFormTypeOption('label', 'Allergènes')
            ->autocomplete()
            ->setHelp('Sélectionnez un ou plusieurs allergènes'),
            AssociationField::new('diets')
            ->setFormTypeOption('multiple', true)
            ->setFormTypeOption('label', 'Régime alimentaires')        
            ->autocomplete()
            ->setHelp('Sélectionnez un ou plusieurs régimes alimentaires'),
        ];
    }
}
