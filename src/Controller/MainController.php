<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class MainController extends AbstractController
{
    #[Route('/', name: 'main_index')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/Test', name: 'main_test')]
    public function test(): Response
    {
        $serie =
            [
                "title" => "Game of Thrones",
                "year" => 2000,
            ];

        return $this->render('main/test.html.twig',
            [
                "mySerie" => $serie,
                "autreVar" => 412412,
            ]);
    }
}