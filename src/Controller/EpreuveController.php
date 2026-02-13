<?php

namespace App\Controller;

use App\Entity\Epreuve;
use App\Form\Epreuve1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller pour gérer les épreuves
 */
#[Route('/epreuve')]
final class EpreuveController extends AbstractController
{
    #[Route(name: 'app_epreuve_index', methods: ['GET'])]
    /** Liste toutes les épreuves */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $epreuves = $entityManager->getRepository(Epreuve::class)->findAll();

        return $this->render('epreuve/index.html.twig', [
            'epreuves' => $epreuves,
        ]);
    }

    #[Route('/new', name: 'app_epreuve_new', methods: ['GET', 'POST'])]
    /** Création d'une épreuve */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $epreuve = new Epreuve();
        $form = $this->createForm(Epreuve1Type::class, $epreuve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($epreuve);
            $entityManager->flush();

            return $this->redirectToRoute('app_epreuve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('epreuve/new.html.twig', [
            'epreuve' => $epreuve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_epreuve_show', methods: ['GET'])]
    /** Affiche une épreuve */
    public function show(Epreuve $epreuve): Response
    {
        return $this->render('epreuve/show.html.twig', [
            'epreuve' => $epreuve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_epreuve_edit', methods: ['GET', 'POST'])]
    /** Modification d'une épreuve */
    public function edit(Request $request, Epreuve $epreuve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Epreuve1Type::class, $epreuve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_epreuve_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('epreuve/edit.html.twig', [
            'epreuve' => $epreuve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_epreuve_delete', methods: ['POST'])]
    /** Suppression d'une épreuve */
    public function delete(Request $request, Epreuve $epreuve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$epreuve->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($epreuve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_epreuve_index', [], Response::HTTP_SEE_OTHER);
    }
}
