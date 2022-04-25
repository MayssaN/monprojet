<?php

namespace App\Controller;

use App\Entity\Travailleur;
use App\Form\TravailleurType;
use App\Repository\TravailleurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/travailleur")
 */
class TravailleurController extends AbstractController
{
    /**
     * @Route("/", name="app_travailleur_index", methods={"GET"})
     */
    public function index(TravailleurRepository $travailleurRepository): Response
    {
        return $this->render('travailleur/index.html.twig', [
            'travailleurs' => $travailleurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_travailleur_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TravailleurRepository $travailleurRepository): Response
    {
        $travailleur = new Travailleur();
        $form = $this->createForm(TravailleurType::class, $travailleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travailleurRepository->add($travailleur);
            return $this->redirectToRoute('app_travailleur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('travailleur/new.html.twig', [
            'travailleur' => $travailleur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_travailleur_show", methods={"GET"})
     */
    public function show(Travailleur $travailleur): Response
    {
        return $this->render('travailleur/show.html.twig', [
            'travailleur' => $travailleur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_travailleur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Travailleur $travailleur, TravailleurRepository $travailleurRepository): Response
    {
        $form = $this->createForm(TravailleurType::class, $travailleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $travailleurRepository->add($travailleur);
            return $this->redirectToRoute('app_travailleur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('travailleur/edit.html.twig', [
            'travailleur' => $travailleur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_travailleur_delete", methods={"POST"})
     */
    public function delete(Request $request, Travailleur $travailleur, TravailleurRepository $travailleurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$travailleur->getId(), $request->request->get('_token'))) {
            $travailleurRepository->remove($travailleur);
        }

        return $this->redirectToRoute('app_travailleur_index', [], Response::HTTP_SEE_OTHER);
    }
}
