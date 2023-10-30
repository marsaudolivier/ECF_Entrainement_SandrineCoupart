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
        $recipes = $entityManager->getRepository(Recipes::class)->findAll();
         return $this->render('recettes/index.html.twig', [
            'controller_name' => 'RecettesController',
            'recipes' => $recipes,
        ]);
    }
}
