<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

class MoviesController extends AbstractController
{
    #[Route('/api/movies')]
    public function list(Connection $db): Response
    {
        $rows = $db->createQueryBuilder()
                ->select("m.*")
                ->from("movies", "m")
                ->setMaxResults(50)
                ->executeQuery()
                ->fetchAllAssociative();
        return $this->json([
                "movies" => $rows
        ]);
    }
    
    #[Route('/api/movies/order')]
    public function order_by(Connection $db, Request $request): Response
    {
        $sort = $request->query->get('sort');
        if ($sort == 'rating') {
            $rows = $db->createQueryBuilder()
                ->select("m.*")
                ->from("movies", "m")
                ->orderBy("m.rating", "DESC")
                ->setMaxResults(50)
                ->executeQuery()
                ->fetchAllAssociative();
        return $this->json([
            "movies" => $rows
        ]);
        }elseif ($sort == 'latest') {
            $rows = $db->createQueryBuilder()
                ->select("m.*")
                ->from("movies", "m")
                ->orderBy("m.release_date", "DESC")
                ->setMaxResults(50)
                ->executeQuery()
                ->fetchAllAssociative();
        return $this->json([
            "movies" => $rows
        ]);
        }
    }

    #[Route('/api/movies/genre/{genre}')]
    public function filter_by_genre(Connection $db, string $genre): Response
    {
        $rows = $db->createQueryBuilder()
            ->select("m.*, g.id AS genre_name")
            ->from("movies", "m")
            ->join("m", "movies_genres", "mg", "m.id = mg.movie_id")
            ->join("mg", "genres", "g", "mg.genre_id = g.id")
            ->where("g.id = :genre")
            ->setParameter("genre", $genre)
            ->setMaxResults(50)
            ->executeQuery()
            ->fetchAllAssociative();

        return $this->json([
            "movies" => $rows
        ]);
    }
    
    #[Route('/api/movies/genres')]
    public function listGenres(Connection $db): Response
    {
        $rows = $db->createQueryBuilder()
                ->select("m.*")
                ->from("genres", "m")
                ->executeQuery()
                ->fetchAllAssociative();
        return $this->json([
                "genres" => $rows
        ]);
    }
}
