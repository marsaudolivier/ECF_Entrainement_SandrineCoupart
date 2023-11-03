<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recipes;
use Doctrine\ORM\EntityManagerInterface;

class RecettesController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes')]
    public function index(EntityManagerInterface $entityManager): Response 
    {
        $recipes = $entityManager->getRepository(Recipes::class)
        ->createQueryBuilder('r')
        ->leftJoin('r.notices', 'n')
        ->addSelect('n')
        ->getQuery()
        ->getResult();
         return $this->render('recettes/index.html.twig', [
            'controller_name' => 'RecettesController',
            'recipes' => $recipes, 
        ]);
    }
    #[Route('/recette/{id}', name: 'app_recette')]
    public function show(EntityManagerInterface $entityManager, $id): Response 
    {
        $recipe = $entityManager->getRepository(Recipes::class)->find($id);
        $notices = $recipe->getNotices();
        $noticesArray = $notices->toArray();
         return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecettesController',
            'recipe' => $recipe,
            'notices' => $noticesArray,
        ]);
    }
}
