<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nb<\d+>?5}', name: 'app_tab')]       //<\d+> spécifie que nb est bien un entier

    public function index($nb): Response
    {
        $notes = [];
        for ($i = 0 ; $i<$nb ; $i++) {
            $notes[] = rand(0,200);
        }

        return $this->render('tab/index.html.twig', [
            'notes' => $notes ,     //On envoie le tableau de notes à Twig qui se chargera de les afficher
        ]);
        
    }
}
