<?php

namespace App\Controller;

use App\Entity\Hebergeur;
use App\Form\HebergeurType;
use App\Repository\HebergeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Repository\UserRepository;

class HebergeurController extends AbstractController
{

    /**
     * @Route("/hebergeur", name="hebergeur_index")
     */

    public function index(HebergeurRepository $hebergeurRepository, UserRepository $userRepository): Response
    {
        return $this->render('hebergeur/index.html.twig', [
            'hebergeurs' => $hebergeurRepository->findAll(),
            'User' => $userRepository->findAll(),
        ]);
    }


    /**
     * @Route("/hebergeur/new", name="hebergeur_new")
     */

    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hebergeur = new Hebergeur();
        $form = $this->createForm(HebergeurType::class, $hebergeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hebergeur);
            $entityManager->flush();

            return $this->redirectToRoute('hebergeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hebergeur/new.html.twig', [
            'hebergeur' => $hebergeur,
            'form' => $form
        ]);
    }

    /**
     * @Route("/hebergeur/{id}/delete", name="hebergeur_show")
     */

    public function show(Hebergeur $hebergeur): Response
    {
        return $this->render('hebergeur/show.html.twig', [
            'hebergeur' => $hebergeur,
        ]);
    }

    /**
     * @Route("/hebergeur/{id}/edit", name="hebergeur_edit") 
     */

    public function edit(Request $request, Hebergeur $hebergeur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HebergeurType::class, $hebergeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('hebergeur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hebergeur/edit.html.twig', [
            'hebergeur' => $hebergeur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/hebergeur/{id}", name="hebergeur_delete")
     */

    public function delete(Request $request, Hebergeur $hebergeur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $hebergeur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hebergeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hebergeur_index', [], Response::HTTP_SEE_OTHER);
    }
}
