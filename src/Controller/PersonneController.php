<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('personne')]
class PersonneController extends AbstractController
{
    #[Route('/', name: 'personne.list')]
    public function index(ManagerRegistry $doctrine):Response
    {
        $repository = $doctrine->getRepository(Personne::class);
        $personnes = $repository->findAll();
        return $this->render('personne/index.html.twig', [
            'personnes'=>$personnes
        ]);
    }



    #[Route('/add', name: 'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $personne = new Personne();
        $personne->setFirstname('Jeremy');
        $personne->setName('Szczepanski');
        $personne->setAge('42');

        //Ajouter l'opération d'insertion de la personne dans ma transaction
        $entityManager->persist($personne);

        //Execute la transaction Todo (methode flash)
        $entityManager->flush();


        return $this->render('personne/detail.html.twig', [
            'personne' => $personne
        ]);
    }
}
