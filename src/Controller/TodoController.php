<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        // Afficher notre tableau de todo
        // Sinon je l'initialise et je l'affiche 
        if(!$session->has('todos')){
            $todos = [
                'achat'=>'acheter une clé',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
        ];
        }
        $session->set('todos',$todos);
        // Si j'ai mon tableau de todo dans ma session je ne fais que l'afficher 
        return $this->render('todo/index.html.twig', [
            'todos' => $todos,
        ]);
    }
}
