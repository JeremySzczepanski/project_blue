<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{

    //Cherche nos users dans la base de données
    #[Route('/first', name: 'first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig', [
            'nom' => 'Szczepanski',
            'prenom' => 'Jeremy',
            'path' => '     '
        ]);
    }


    //Route de test d'affichage
    #[Route('/order/{maVar}', name: 'test.order.route')]
    public function testOrderRoute($maVar) 
    {
        return new Response(content: "<html><body>$maVar</body></html>");
    }


    //Route d'affichage d'un template Bootstrap (template.html.twig)
    #[Route('/template', name: 'template.bootstrap')]
    public function template() 
    {
        return $this->render('template.html.twig');
    }


    // #[Route('/sayHello/{name}/{firstname}', name: 'say.hello')]
    public function sayHello($name, $firstname): Response
    {
        return $this->render('first/hello.html.twig', [
            'nom' => $name,
            'prenom' => $firstname,
            // 'path' => '     '

        ]);
    }


    
}
