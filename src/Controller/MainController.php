<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/Test', name: 'test')]
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