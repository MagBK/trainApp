<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('personne')]
final class PersonneController extends AbstractController
{
    #[Route('/',name:'peronne.list')]
    public function index(ManagerRegistry $doctrine): Response 
    {
        $repository = $doctrine->getRepository(Personne::class);
        $personnes = $repository->findAll();
        return $this->render('personne/index.html.twig',['personnes' => $personnes]);
    }
    #[Route('/add', name: 'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        //$this->getDoctrine() :version symfony < 5
        $entityManager = $doctrine->getManager();
        $personne = new Personne;
        $personne->setFirstname('Magloire');
        $personne->setName('BAKA');
        $personne->setAge(26);
        $personne2 = new Personne;
        $personne2->setFirstname('Giannis');
        $personne2->setName('BAKA');
        $personne2->setAge(4);

        //Ajoute la personne instancié dans la base de données
        $entityManager->persist($personne);
        $entityManager->persist($personne2);
        //Execute l'operation
        $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }
}
