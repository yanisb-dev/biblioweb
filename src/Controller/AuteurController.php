<?php

namespace App\Controller;

use App\Entity\Auteur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    #[Route('/auteur', name: 'app_auteur')]
    public function index(): Response
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
        ]);
    }

    public function auteurs(ManagerRegistry $doctrine): Response
    {
        $auteurs = [];

        $auteurs = $doctrine->getRepository(Auteur::class)->findAll();

        return $this->render('auteur/index.html.twig', ['auteurs' => $auteurs]);
    }

    public function showAuteurLivres(ManagerRegistry $doctrine, int $id): Response
    {
        $livres = [];
        $auteur = null;

        $auteur = $doctrine->getRepository(Auteur::class)->find($id);
        $livres = $doctrine->getRepository(Auteur::class)->find($id)->getLivres();

        return $this->render('auteur/showAuteurLivres.html.twig', [
            'livres' => $livres,
            'auteur' => $auteur
        ]);
    }

    public function showAuteurLivresByNom(ManagerRegistry $doctrine, String $nomAuteur): Response
    {
        $livres = $doctrine->getRepository(Auteur::class)->findByNomAuteur($nomAuteur);

        return $this->render('auteur/showAuteurLivres.html.twig', [
            'nomAuteur' => $nomAuteur,
            'livres' => $livres
        ]);
    }
}
