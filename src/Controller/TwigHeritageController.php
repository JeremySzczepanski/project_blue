<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigHeritageController extends AbstractController
{
    #[Route('/twig', name: 'twig_heritage')]
    public function index(): Response
    {
        return $this->render('twig_heritage/index.html.twig', [
            'controller_name' => 'TwigHeritageController',
        ]);
    }

    #[Route('/twig/heritage', name: 'heritage')]
    public function heritage(): Response
    {
        return $this->render('heritage.html.twig'    //on lui demande juste d'afficher la page heritage.html.twig
        );                                           //::heritage.html.twig (les "::" sont l'ancienne façon de noter les pages)
    }
}
