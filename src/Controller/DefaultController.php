<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{


    public function connexion(): Response
    {
        return $this->render("connexion.html.twig");
    }

    public function accueil(): Response
    {
        return  $this->render('index.html.twig', ['titre' => "Titre de la page d'accueil"]);
    }

    public function recherche(): Response
    {
        return $this->render("recherche.html.twig");
    }
    public function informationspratiques(): Response
    {
        return new Response(
            "<html><body>Retrouvez toutes les informations pratiques sur cette page<a href=" . $this->generateUrl('accueil') . "> Retour à l'accueil </a></body></html>"
        );
    }
}
