<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series', name: 'serie_')]
class SerieController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function list(): Response
    {
        //TODO renvoyer la liste des series
        return $this->render('serie/list.html.twig');
    }

    #[Route('/{id}', name: 'show',  requirements: ["id" => "\d+"])]
    public function show(int $id): Response
    {
        dump($id);
        //TODO renvoyer le détail d'une série
        return $this->render('serie/show.html.twig');
    }

    #[Route('/add', name: 'add')]
    public function add(): Response
    {
        //TODO renvoyer un formulaire pour créer une nouvelle série
        return $this->render('serie/add.html.twig');
    }
}
