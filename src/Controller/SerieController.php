<?php

namespace App\Controller;

use DateTime;
use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/series', name: 'serie_')]
class SerieController extends AbstractController
{
    #[Route('/List', name: 'list')]
    public function list(SerieRepository $serieRepository) : Response
    {
        //$series = $serieRepository->findBy([], ['popularity' => 'DESC', 'vote' => 'DESC'], 30, 10);
        //dd($series);

        $series = $serieRepository->findBestSeries();

        return $this->render('serie/list.html.twig',
        [
            'series' => $series
        ]);
    }

    #[Route('/details/{id}', name: 'details')]
    public function details(int $id, SerieRepository $serieRepository): Response
    {
        $serie = $serieRepository->find($id);

        //Si elle n'existe pas en bdd, on déclenche une erreur 404
        if (!$serie)
        {
            throw $this->createNotFoundException('Cette série n\'existe pas ! Désolé :(');
        }

        return $this->render('serie/details.html.twig',
            [
                'serie' => $serie
            ]);
    }

    #[Route('/Create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $serie = new Serie();
        $serie->setDateCreated(new DateTime());//ancienne ligne de code : $serie->setDateCreated(new \DateTime()); + Ajout de use DateTime;
        $serieForm = $this->createForm(SerieType::class, $serie);

        //dump($serie);
        $serieForm->handleRequest($request);
        //dump($serie);

        if ($serieForm->isSubmitted() && $serieForm->isValid())
        {
            $entityManager->persist($serie);
            $entityManager->flush();
            $this->addFlash('success', 'la série a bien été ajouté');
            return $this->redirectToRoute('serie_details', ['id'=>$serie->getId()]);
        }

        return $this->render('serie/create.html.twig', [ 'serieForm' => $serieForm->createView() ]);
    }

    /*#[Route('/demo', name: 'demo')]
    public function demo(EntityManagerInterface $entityManager): Response
    {
        #Création d'une instance de l'entité Serie
        $serie = new serie();

        // hydrate toutes les propriétés
        $serie->setName('pif');
        $serie->setBackdrop('dafsd');
        $serie->setPoster('dafsd');
        $serie->setDateCreated(new \DateTime());
        $serie->setFirstAirDate(new \DateTime("-1 year"));
        $serie->setLastAirDate(new \DateTime("-6 month"));
        $serie->setGenres('drama');
        $serie->setOverview('bla bla bla');
        $serie->setPopularity(123.00);
        $serie->setVote(8.2);
        $serie->setStatus('Canceled');
        $serie->setTmdbId(329432);

        dump($serie);

        $entityManager->persist($serie);
        $entityManager->flush();

        dump($serie);

        //$entityManager->remove($serie);
        $serie->setGenres('comedy');

        $entityManager->flush();

        return $this->render('serie/create.html.twig');
    }*/

    #[Route('/Delete/{id}', name: 'delete')]
    public function delete(Serie $serie, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($serie);
        $entityManager->flush();

        return $this->redirectToRoute('main_index');
    }
}