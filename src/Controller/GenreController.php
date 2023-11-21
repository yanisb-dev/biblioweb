<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Entity\Livre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    #[Route('/genre', name: 'app_genre')]
    public function index(): Response
    {
        return $this->render('genre/index.html.twig', [
            'controller_name' => 'GenreController',
        ]);
    }

    public function showGenreLivres(ManagerRegistry $doctrine, int $id): Response
    {

        $genre = $doctrine->getRepository(Genre::class)->find($id);

        // $livres = $doctrine->getRepository(Livre::class)->findAllByGenre($genre);
        $livres = $genre->getLivres();


        return $this->render('genre/index.html.twig', ['livres' => $livres, 'genre' => $genre]);
    }
}
