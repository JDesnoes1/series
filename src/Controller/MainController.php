<?php

namespace App\Controller;

use App\Entity\Serie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main_home')]
    public function home(): Response
    {
        return $this->render("main/home.html.twig");
    }

    #[Route('/test', name: 'main_test')]
    public function test(): Response
    {
        $username = "Jérémie";
        $serie = ["title" => "The Witcher", "year" => 2019];

        /*$serie = new Serie();
        $serie
            ->setBackdrop("backdrop.png")
            ->setDateCreated(new \DateTime())
            ->setGenres("Thriller/Drama")
            ->setName("Utopia")
            ->setFirstAirDate(new \DateTime("-2 year"))
            ->setLastAirDate(new \DateTime("-2 month"))
            ->setPopularity(500)
            ->setPoster("poster.png")
            ->setStatus("Canceled")
            ->setTmdbId(123456)
            ->setVote(5);

        $serieRepository->save($serie, true);*/

        /*dump($serie);

        //Sauvegarde de mon instance grâce à l'entityManager
        $entityManager -> persist($serie);
        $entityManager -> flush();

        dump($serie);

        $serie->setName("The Witcher");
        $entityManager -> persist($serie);
        $entityManager -> flush();

        dump($serie);

        $entityManager->remove($serie);
        $entityManager -> flush();*/

        return $this->render("main/test.html.twig", [
            "nameOfUser" => $username,
            "mySerie" => $serie
        ]);

    }
}
