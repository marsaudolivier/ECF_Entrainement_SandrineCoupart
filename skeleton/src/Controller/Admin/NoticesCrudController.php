<?php

namespace App\Controller\Admin;

use App\Entity\Notices;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NoticesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Notices::class;
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
