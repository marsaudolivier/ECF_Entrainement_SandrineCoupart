<?php

namespace App\Controller\Admin;

use App\Entity\DietTypes;
use App\Entity\Recipes;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class RecipesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipes::class;
        return DietTypes::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Recettes')
            ->setEntityLabelInSingular('Recette')
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des %entity_label_plural%')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un %entity_label_singular%')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Détails du %entity_label_singular%');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title','Titre'),
            TextEditorField::new('description'),
            ImageField::new('image')
                ->setBasePath('upload/recipes')
                ->setUploadDir('public/upload/recipes')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]'),
            TextField::new('TotalTime','Temps Total'),
            TextField::new('PreparationTime','Temps de préparation'),
            TextField::new('TimeOfRest','Temps de repot'),
            TextField::new('CookingTime','Temps de cuisson'),
            TextEditorField::new('steps','Etape de préparation'),
            BooleanField::new('patients_accessible','Ouvert à tout le monde'),
            AssociationField::new('diets')
            ->setFormTypeOption('multiple', true)
            ->setFormTypeOption('label', 'Régime alimentaires')        
            ->autocomplete()
            ->setHelp('Sélectionnez un ou plusieurs régimes alimentaires'),
            AssociationField::new('allergen')
            ->setFormTypeOption('multiple', true)
            ->setFormTypeOption('label', 'Allergènes')
            ->autocomplete()
            ->setHelp('Sélectionnez un ou plusieurs allergènes'),
            AssociationField::new('ingredien')
            ->setFormTypeOption('multiple', true)
            ->setFormTypeOption('label', 'Ingrédients')
            ->autocomplete()
            ->setHelp('Sélectionnez un ou plusieurs ingrédients'),
        ];
    }
    
}
        

