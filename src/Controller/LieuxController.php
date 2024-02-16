<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lieu;

class LieuxController extends AbstractController
{
    #[Route('/lieux', name: 'app_lieux')]
    public function index(): Response
    {
        return $this->render('lieux/index.html.twig', [
            'controller_name' => 'LieuxController',
        ]);
    }
    #[Route('/frontLieux', name: 'app_front_lieux')]
    public function indexLieux(): Response
    {
        return $this->render('Front/lieux/index.html.twig');
    }
}
