<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Allergens;
use App\Entity\DietTypes;
use App\Entity\Recipes;
use App\Entity\Ingredients;
use App\Entity\Notices;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration ')
            ->renderContentMaximized();
    }
          

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Menu', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateur ', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Recettes ', 'fas fa-biohazard', Recipes::class);
        yield MenuItem::linkToCrud('Ingrédient ', 'fas fa-biohazard', Ingredients::class);
        yield MenuItem::linkToCrud('Allergène ', 'fas fa-biohazard', Allergens::class);
        yield MenuItem::linkToCrud('Régime Alimentaire ', 'fas fa-utensils', DietTypes::class);
        yield MenuItem::linkToCrud('Contact ', 'fas fa-message', Contact::class);
        yield MenuItem::linkToCrud('note ', 'fas fa-message', Notices::class);
    }
}