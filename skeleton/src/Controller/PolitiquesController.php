<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PolitiquesController extends AbstractController
{
    #[Route('/politiques', name: 'app_politiques')]
    public function index(): Response
    {
        return $this->render('politiques/index.html.twig', [
            'controller_name' => 'PolitiquesController',
        ]);
    }
}
