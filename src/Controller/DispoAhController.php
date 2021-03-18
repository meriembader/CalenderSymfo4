<?php

namespace App\Controller;

use App\Entity\DispoAh;
use App\Form\DispoAhType;
use App\Repository\DispoAhRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dispo/ah")
 */
class DispoAhController extends AbstractController
{
    /**
     * @Route("/calendar", name="dispoAh_calendar", methods={"GET"})
     */
    public function index(DispoAhRepository $dispoAhRepository): Response
    {
        return $this->render('dispo_ah/index.html.twig', [
            'dispo_ahs' => $dispoAhRepository->findAll(),
        ]);
    }
    /**
     * @Route("/calendar1", name="dispoAh_calendar", methods={"GET"})
     */
    public function calendar1(): Response
    {
        return $this->render('dispo_ah/calendar.html.twig');
    }
    /**
     * @Route("/calendar", name="dispoAh_calendar", methods={"GET"})
     */
    public function calendar(DispoAhRepository $dispoAhRepository )

    {
        $events = $dispoAhRepository->findAll();

        $rdvs = [];

        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'start' => $event->getDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                'description' => $event->getDescp(),

                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('dispo_ah/calendar.html.twig', compact('data'));
    }

/**
     * @Route("/new", name="dispo_ah_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dispoAh = new DispoAh();
        $form = $this->createForm(DispoAhType::class, $dispoAh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dispoAh);
            $entityManager->flush();

            return $this->redirectToRoute('dispo_ah_index');
        }

        return $this->render('dispo_ah/new.html.twig', [
            'dispo_ah' => $dispoAh,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dispo_ah_show", methods={"GET"})
     */
    public function show(DispoAh $dispoAh): Response
    {
        return $this->render('dispo_ah/show.html.twig', [
            'dispo_ah' => $dispoAh,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dispo_ah_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DispoAh $dispoAh): Response
    {
        $form = $this->createForm(DispoAhType::class, $dispoAh);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dispo_ah_index');
        }

        return $this->render('dispo_ah/edit.html.twig', [
            'dispo_ah' => $dispoAh,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dispo_ah_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DispoAh $dispoAh): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dispoAh->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dispoAh);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dispo_ah_index');
    }
}
