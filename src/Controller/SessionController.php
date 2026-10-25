<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();

        // Récupérer le nombre de visites ou initialiser à 0
        $nbreVisit = $session->get('nbreVisit', 0);

        // Incrémenter le nombre de visites
        $nbreVisit++;

        // Enregistrer le nouveau nombre dans la session
        $session->set('nbreVisit', $nbreVisit);

        return $this->render('session/index.html.twig', [
            'nbreVisit' => $nbreVisit,
        ]);
    }
}