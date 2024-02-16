<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\AddlType;
use App\Repository\LieuRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminlController extends AbstractController
{
    
    
    #[Route('/showdbl', name: 'showdblieu')]
    public function showdblieu(LieuRepository $lieuRepository): Response
    {
        $l = $lieuRepository->findAll();
        return $this->render('adminl/index.html.twig', [
            'l' => $l
        ]);
    }
    
    #[Route('/addforml', name: 'addforml')]
    public function addforml(ManagerRegistry $managerRegistry, Request $req): Response
    {
        $x = $managerRegistry->getManager();
        $l = new Lieu();
        $form = $this->createForm(AddlType::class, $l);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $x->persist($l);
            $x->flush();

            return $this->redirectToRoute('showdblieu');
        }
        return $this->renderForm('adminl/lieuform.html.twig', [
            'f' => $form
        ]);
    }
    
    #[Route('/editl/{id}', name: 'editlieu')]
    public function editroom($id,LieuRepository $lieuRepository, ManagerRegistry $managerRegistry,Request $req): Response
    {
        //var_dump($id) . die();
        $x = $managerRegistry->getManager();
        $dataid = $lieuRepository->find($id);
        // var_dump($dataid) . die();
        $form = $this->createForm(AddlType::class, $dataid);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $x->persist($dataid);
            $x->flush();
            return $this->redirectToRoute('showdblieu');
        }
        return $this->renderForm('adminl/editlieu.html.twig', [
            'x' => $form
        ]);
    }  

    #[Route('/deletel/{id}', name: 'deletel')]
    public function deletelieu($id, ManagerRegistry $managerRegistry, LieuRepository $lieuRepository): Response
    {
        $em = $managerRegistry->getManager();
        $dataid = $lieuRepository->find($id);
        $em->remove($dataid);
        $em->flush();
        return $this->redirectToRoute('showdblieu');
    }
    
}
