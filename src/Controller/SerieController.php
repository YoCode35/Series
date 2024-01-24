<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SerieController extends AbstractController
{
    #[Route('/List', name: 'main_list')]
    public function list(): Response
    {
        //TODO : Aller chercher les séries en Bdd

        return $this->render('serie/list.html.twig',
        [

        ]);
    }

    #[Route('/Details', name: 'main_details')]
    public function details(): Response
    {
        //todo : aller cherche la série dans la bdd
        return $this->render('serie/details.html.twig');
    }

    #[Route('/Create', name: 'main_create')]
    public function create(): Response
    {
        return $this->render('serie/create.html.twig');
    }
}