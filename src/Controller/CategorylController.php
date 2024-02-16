<?php

namespace App\Controller;

use App\Entity\CategoryL;
use App\Form\CategorylType;
use App\Repository\CategoryLRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Lieu;
class CategorylController extends AbstractController
{
    #[Route('/showcatl', name: 'showcategoryl')]
    public function showcat(): Response
    {
        return $this->render('categoryl/index.html.twig');
    }
    #[Route('/showdbcat', name: 'showdbcategory')] //affichage
    public function showdbauthor(CategoryLRepository $catRepository): Response
    {

        $cat=$catRepository->findAll();
        return $this->render('categoryl/showdbcat.html.twig', [
            'cat'=>$cat

        ]);
    }
    #[Route('/addformcat', name: 'addformCat')]
    public function addformroom(ManagerRegistry $managerRegistry, Request $req): Response
    {
        $x = $managerRegistry->getManager();
        $cat = new CategoryL();
        $form = $this->createForm(CategorylType::class, $cat);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $x->persist($cat);
            $x->flush();

            return $this->redirectToRoute('showdbcategory');
        }
        return $this->renderForm('categoryl/addCategory.html.twig', [
            'f' => $form
        ]);
    }

    /*
    #[Route('/editcat/{id}', name: 'editcat')]
    public function editroom($id,CategoryLRepository $catRepository, ManagerRegistry $managerRegistry,Request $req): Response
    {
        //var_dump($id) . die();
        $x = $managerRegistry->getManager();
        $dataid = $catRepository->find($id);
        // var_dump($dataid) . die();
        $form = $this->createForm(CategorylType::class, $dataid);
        $form->handleRequest($req);
        if ($form->isSubmitted() and $form->isValid()) {
            $x->persist($dataid);
            $x->flush();
            return $this->redirectToRoute('showdbcategory');
        }
        return $this->renderForm('categoryl/editCategory.html.twig', [
            'x' => $form
        ]);
    }  
    */
    #[Route('/deletecat/{id}', name: 'deletecat')]
    public function deleteroom($id, ManagerRegistry $managerRegistry, CategoryLRepository $catRepository): Response
    {
        $em = $managerRegistry->getManager();
        $dataid = $catRepository->find($id);
        $em->remove($dataid);
        $em->flush();
        return $this->redirectToRoute('showdbcategory');
    }

}
