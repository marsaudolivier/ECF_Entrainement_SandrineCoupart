<?php

namespace App\Controller;

use App\Entity\Notices;
use App\Entity\Recipes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;



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

    #[Route('/api/recipe/{id}/add-note/{note}', name: 'add_recipe_note',)]
    public function addNote(int $id,int $note, Request $request, EntityManagerInterface $em, LoggerInterface $logger)
    {
        $recipe = $em->getRepository(Recipes::class)->find($id);
        $note = (int) $note;
        $notice = new Notices();
        $notice->setRecipes($recipe);
        $notice->setNote($note);
        $em->persist($notice);
        $em->flush();
        $notices = $recipe->getAllNotices();
        //retour json sous tableau nom data
        return new JsonResponse(['data'=>$notices]);
    }
}
