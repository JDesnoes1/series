<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/series', name: 'serie')]
class SerieController extends AbstractController
{
    #[Route('/', name: 'serie_list')]
    public function list(): Response
    {
        //TODO renvoyer la liste des series
        return $this->render('serie/list.html.twig');
    }

    #[Route('/{id}', name: 'serie_show')]
    public function show(int $id): Response
    {
        //TODO renvoyer le détail d'une série
        return $this->render('serie/show.html.twig');
    }

    #[Route('/add', name: 'serie_add')]
    public function add(): Response
    {
        //TODO renvoyer un formulaire pour créer une nouvelle série
        return $this->render('serie/add.html.twig');
    }
}
