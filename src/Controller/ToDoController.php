<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request){

        $session = $request->getSession();
        // Afficher notre tableau de todo
        // Si j'ai mon tableau de todo: je l'initialise puis je l'affiche
        if (!$session->has(name:'todos')) {
            $todos = [
                'achat'=>'acheter clé usb',
                'cours'=>'Finaliser mon cours',
                'correction'=>'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash(type:'info', message:"La liste des todos vient d'être initialisée");
        } else {
        // Sinon je ne fait que l'afficher
            return $this->render('todo/index.html.twig');
        }
    }

    #[Route('/todo/add/{name}/{content}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content): RedirectResponse {

        $session = $request->getSession();

        //vérifier si j'ai mon tableau de todo dans la session

        if ($session->has(name:'todos')) {
            //si oui 
                //vérifier si on a deja un todo avec le meme name
                $todos = $session->get(name:'todos');
                if (isset($todos[$name])) {

                //si oui on affiche erreur
                $this->addFlash(type:'error', message:"Le todo d'id $name existe déjà dans la liste");
                } else {

                //si non on l'ajoute et on affiche un message de succès
                $todos[$name] = $content;
                $this->addFlash(type:'success', message:"Le todo d'id $name à été ajouté avec succès");
                $session->set('todos', $todos);
                }
        } else {

        
            
            //si non
                //afficher une erreur et rediriger vers le controller initial (index)
                $this->addFlash(type:'error', message:"La liste des todos n'est pas encore initialisée");

        }
        return $this->redirectToRoute(route:'todo');
    }


    #[Route('/todo/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content): RedirectResponse {
 
        $session = $request->getSession();
 
     //vérifier si j'ai mon tableau de todo dans la session
 
     if ($session->has(name:'todos')) {
         //si oui 
             //vérifier si on a deja un todo avec le meme name
             $todos = $session->get(name:'todos');
             if (!isset($todos[$name])) {
 
             //si oui on affiche erreur
             $this->addFlash(type:'error', message:"Le todo d'id $name n'existe pas dans la liste");
             } else {
 
             //si non on l'ajoute et on affiche un message de succès
             $todos[$name] = $content;
             $this->addFlash(type:'success', message:"Le todo d'id $name à été modifié avec succès");
             $session->set('todos', $todos);
             }
     } else {
 
     
         
         //si non
             //afficher une erreur et rediriger vers le controller initial (index)
             $this->addFlash(type:'error', message:"La liste des todos n'est pas encore initialisée");
 
     }
     return $this->redirectToRoute(route:'todo');
 
 
      }

#[Route('/todo/delete/{name}', name: 'todo.delete')]
    public function deleteTodo(Request $request, $name): RedirectResponse{
  
      $session = $request->getSession();
  
      //vérifier si j'ai mon tableau de todo dans la session
  
      if ($session->has(name:'todos')) {
          //si oui 
              //vérifier si on a deja un todo avec le meme name
              $todos = $session->get(name:'todos');
              if (!isset($todos[$name])) {
  
              //si oui on affiche erreur
              $this->addFlash(type:'error', message:"Le todo d'id $name n'existe pas dans la liste");
              } else {
  
              //si non on l'ajoute et on affiche un message de succès
              unset($todos[$name]);
              $this->addFlash(type:'success', message:"Le todo d'id $name à été supprimé avec succès");
              $session->set('todos', $todos);
              }
      } else {
  
      
          
          //si non
              //afficher une erreur et rediriger vers le controller initial (index)
              $this->addFlash(type:'error', message:"La liste des todos n'est pas encore initialisée");
  
      }
      return $this->redirectToRoute(route:'todo');
  
    }

#[Route('/todo/reset', name: 'todo.reset')]
    public function resetTodo(Request $request): RedirectResponse{
   
        $session = $request->getSession();
        $session->remove(name:'todos');
        return $this->redirectToRoute(route:'todo');
    }

}



