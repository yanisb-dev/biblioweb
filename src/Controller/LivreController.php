<?php

namespace App\Controller;

use App\Entity\Livre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{


    #[Route('/livre', name: 'app_livre')]

    public function index(): Response
    {
        $livres = [];
        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
            'livres' => $livres,
            'titre' => "Liste de livres",
        ]);
    }

    public function livres(ManagerRegistry $doctrine): Response

    {
        $livres = [];
        $livres = $doctrine->getRepository(Livre::class)->findAll();


        return $this->render('livre/index.html.twig', ['livres' => $livres]);
    }

    public function showLivre(ManagerRegistry $doctrine, int $id): Response
    {

        $livre = $doctrine->getRepository(Livre::class)->find($id);
        if (!$livre) {
            throw $this->createNotFoundException(
                'Aucun livre pour l\'id ' . $id
            );
        } else {
            return $this->render('livre/showLivre.html.twig', ['titre' => 'Détail du livre', 'livre' => $livre]);
        }
    }


    public function showGenre(ManagerRegistry $doctrine, int $id): Response
    {

        $genres = $doctrine->getRepository(Livre::class)->find($id)->getGenres();
        return $this->render('showGenres.html.twig', ['genres' => $genres]);
    }
}
