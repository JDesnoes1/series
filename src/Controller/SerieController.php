<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

#[Route('/series', name: 'serie_')]
class SerieController extends AbstractController
{
    #[Route('/{page}', name: 'list', requirements: ["page" => "\d+"])]
    public function list(SerieRepository $serieRepository, int $page = 1): Response
    {
        //TODO renvoyer la liste des series

        /*$series = $serieRepository ->findBy([], ["popularity" => "DESC"], 50, 0);*/
        /*$series = $serieRepository->findBestSeries();*/

        $nbSeries = $serieRepository->count([]);

        $maxPage = ceil($nbSeries/ Serie::MAX_RESULT);

        //Gestion page <1
        if($page < 1) return $this->redirectToRoute('serie_list', ['page' => 1]) ;
        if($page > $maxPage) return $this->redirectToRoute('serie_list', ['page' => $maxPage]);
        else {
            $series = $serieRepository->findSeriesWithPagination($page);
            return $this->render('serie/list.html.twig', [
                'page' => $page,
                'series' => $series,
                'maxPage' => $maxPage
            ]);
        }
    }

    #[Route('/detail/{id}', name: 'show',  requirements: ["id" => "\d+"])]
    public function show(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository ->find($id);
        if(!$serie) throw $this->createNotFoundException("Oups ! Serie not found");

        //TODO renvoyer le détail d'une série
        return $this->render('serie/show.html.twig', [
            'serie' => $serie
        ]);
    }
    #[isGranted("ROLE_USER")]
    #[Route('/add/momo', name: 'add')]
    public function add(Request $request, SerieRepository $serieRepository): Response
    {
        //TODO renvoyer un formulaire pour créer une nouvelle série
        $serie = new Serie();
        $serieForm = $this->createForm(SerieType::class, $serie);

        //Permet d'extraire les données de la requête
        $serieForm->handleRequest($request);

        if($serieForm->isSubmitted() && $serieForm->isValid()){
            $genres = $serieForm->get('genres')->getData();
            $serie->setGenres(implode('/', $genres));
            $serie->setDateCreated(new \DateTime());

            $serieRepository->save($serie, true);

            $this->addFlash('success', 'Serie added !');
            return $this->redirectToRoute('serie_show', ['id' => $serie->getId()]);
        }

        return $this->render('serie/add.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function edit(int $id, SerieRepository $serieRepository) {
        $serie = $serieRepository->find($id);
        $serieForm = $this->createForm(SerieType::class, $serie);

        return $this->render('serie/update.html.twig', [
            'serieForm' => $serieForm->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(int $id, SerieRepository $serieRepository) {

        $serie = $serieRepository->find($id);
        $serieRepository->remove($serie, true);
        $this->addFlash('success', $serie->getName() . "has been removed");

        return $this->redirectToRoute('main_home');
    }
}
