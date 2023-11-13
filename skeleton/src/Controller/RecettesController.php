<?php

namespace App\Controller;

use App\Entity\Notices;
use App\Entity\Recipes;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecettesController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes')]
    public function index(EntityManagerInterface $entityManager , Security $security): Response
    {
        $recipes = $entityManager->getRepository(Recipes::class)->findAll();
       // Vérifie si l'utilisateur est connecté

    if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
        // Vérifie si l'utilisateur a le rôle PATIENT
        if ($security->isGranted('ROLE_PATIENT')) {
              // L'utilisateur a le rôle PATIENT, afficher la vue recetteUser
                    // Récupérez l'utilisateur connecté
                    $user = $this->getUser();
                    // Récupérez les allergènes et les diet types de l'utilisateur
                    $diets = $user->GetAllDiets();
                    $allergens = $user->GetAllAllergen();
                    
                    // L'utilisateur a le rôle UTILISATEUR, afficher la vue recettesUser
            return $this->render('recettesUser/index.html.twig', [
                'controller_name' => 'RecettesController',
                'recipes' => $recipes,
                'users' => $user,
                'diets' => $diets,
                'allergens' => $allergens,
            ]);
        }
    }
    // L'utilisateur n'est pas connecté ou n'a pas le rôle PATIENT, afficher la vue recettes
    return $this->render('recettes/index.html.twig', [
        'controller_name' => 'RecettesController',
        'recipes' => $recipes,
    ]);
    }
    #[Route('/recette/{id}', name: 'app_recette')]
    public function show(EntityManagerInterface $entityManager, $id  , Security $security): Response
    {
        $recipe = $entityManager->getRepository(Recipes::class)->find($id);
        $notices = $recipe->getNotices();
        $noticesArray = $notices->toArray();
        if ($security->isGranted('IS_AUTHENTICATED_FULLY')) {
            // Vérifie si l'utilisateur a le rôle PATIENT
            if ($security->isGranted('ROLE_PATIENT')) {
                // L'utilisateur a le rôle PATIENT, afficher la vue recetteUser
            // Récupérez les allergènes et les diet types de l'utilisateur
                return $this->render('recetteUser/index.html.twig', [
                    'controller_name' => 'RecettesController',
                    'recipe' => $recipe,
                    'notices' => $noticesArray,
  
                ]);
            }
        }
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecettesController',
            'recipe' => $recipe,
        ]);
    }
    #[Route('/api/recipe/{id}/add-note/{note}/{user}/{newComment}', name: 'add_recipe_note')]
    public function addNote(int $id, int $note, int $user, $newComment, Request $request, EntityManagerInterface $em, LoggerInterface $logger)
    {
        $recipe = $em->getRepository(Recipes::class)->find($id);
        $note = (int) $note;
        $users = (int) $user;
        $comment = $newComment;
        $notice = new Notices();
        $notice->setRecipes($recipe);
        $notice->setNote($note);
        $notice->setUser($users);
        $notice->setComment($comment);
        $em->persist($notice);
        $em->flush();
        $notices = $recipe->getAllNotices();
        //retour json sous tableau nom data
        return new JsonResponse(['data'=>$notices]);
    }
}
