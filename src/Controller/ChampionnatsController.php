<?php

namespace App\Controller;

use App\Entity\Championnats;
use App\Form\ChampionnatsType;
use App\Repository\ChampionnatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/championnats')]
final class ChampionnatsController extends AbstractController
{
    #[Route(name: 'app_championnats_index', methods: ['GET'])]
    public function index(ChampionnatsRepository $championnatsRepository): Response
    {
        return $this->render('championnats/index.html.twig', [
            'championnats' => $championnatsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_championnats_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $championnat = new Championnats();
        $form = $this->createForm(ChampionnatsType::class, $championnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($championnat);
            $entityManager->flush();

            return $this->redirectToRoute('app_championnats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('championnats/new.html.twig', [
            'championnat' => $championnat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_championnats_show', methods: ['GET'])]
    public function show(Championnats $championnat): Response
    {
        return $this->render('championnats/show.html.twig', [
            'championnat' => $championnat,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_championnats_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Championnats $championnat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ChampionnatsType::class, $championnat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_championnats_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('championnats/edit.html.twig', [
            'championnat' => $championnat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_championnats_delete', methods: ['POST'])]
    public function delete(Request $request, Championnats $championnat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$championnat->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($championnat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_championnats_index', [], Response::HTTP_SEE_OTHER);
    }
}
