<?php

namespace App\Controller;

use App\Entity\DispoAh;
use App\Entity\Medecin;
use DateTime;
use App\Form\DispoAhType;
use App\Repository\DispoAhRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dispo/ah")
 */
class DispoAhController extends AbstractController
{

    /**
     * @Route("/calendarA/{id}", name="dispo_ah_indexA", methods={"GET"})
     */
    public function indexA(DispoAhRepository $dispoAhRepository, Medecin $id )

    {

     /*   $events = $dispoAhRepository->findBy(['refto_med_id' => $id->getId()]);

        $rdvs = [];

        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'refto_med_id'=> $event->getReftoMedId(),
                'start' => $event->getDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                'description' => $event->getDescp(),
                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('dispo_ah/calendar.html.twig', compact('data'));*/
    }

    /**
     *@param Request $request
     * @return JsonResponse
     * @Route("/momo",name="momo",options={"expose" = true}, methods={"POST"})
     */

    public function momo(Request $request) {
        $medId = $request->request->get('medId');
        dump($medId);die();
        return $this->json([
            "success" => true,
        ]);
    }






    /**
     * @Route("/calendar", name="dispo_ah_index", methods={"GET"})
     */
    public function index(DispoAhRepository $dispoAhRepository )

    {
        $events = $dispoAhRepository->findAll();

        $rdvs = [];

        foreach ($events as $event) {
            $rdvs[] = [
                'id' => $event->getId(),
                'refto_med_id'=> $event->getReftoMedId(),
                'start' => $event->getDebut()->format('Y-m-d H:i:s'),
                'end' => $event->getFin()->format('Y-m-d H:i:s'),
                'title' => $event->getTitre(),
                'description' => $event->getDescp(),

                'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdvs);

        return $this->render('dispo_ah/index.html.twig', compact('data'));
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
   /* public function show(DispoAh $dispoAh): Response
    {
        return $this->render('dispo_ah/show.html.twig', [
            'dispo_ah' => $dispoAh,
        ]);
    }
*/
    /**
     * @Route("/{id}/edit", name="dispo_ah_edit", methods={"GET","POST"})
     */

/*
    public function edit(DispoAh $calendar, Request $request): Response
    {
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description)

        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$calendar){
                // On instancie un rendez-vous
                $calendar = new DispoAh();

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $calendar->setTitre($donnees->title);
            $calendar->setDescp($donnees->description);
            $calendar->setDebut(new DateTime($donnees->start));
            if($donnees->allDay){
                $calendar->setFin(new DateTime($donnees->start));
            }else{
                $calendar->setFin(new DateTime($donnees->end));
            }
            $calendar->setAllDay($donnees->allDay);


            $em = $this->getDoctrine()->getManager();
            $em->persist($calendar);
            $em->flush();

            // On retourne le code
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }
        return $this->render('dispo_ah/index.html.twig');

    }

*/


    /**
     * @Route("/{id}/edit", name="dispo_ah_edit1", methods={ "GET","POST"})
     */
    public function majEvent(DispoAh  $dispoAh, Request $request)
    {
        // On récupère les données
        $donnees = json_decode($request->getContent());

        if(
            isset($donnees->title) && !empty($donnees->title) &&
            isset($donnees->start) && !empty($donnees->start) &&
            isset($donnees->description) && !empty($donnees->description)&&
            isset($donnees->end) && !empty($donnees->end)&&
            isset($donnees->refto_med_id) && !empty($donnees->refto_med_id)
        ){
            // Les données sont complètes
            // On initialise un code
            $code = 200;

            // On vérifie si l'id existe
            if(!$dispoAh){
                // On instancie un rendez-vous
                $dispoAh = new DispoAh();

                // On change le code
                $code = 201;
            }

            // On hydrate l'objet avec les données
            $dispoAh->setTitre($donnees->titre);
            $dispoAh->setDescp($donnees->description);
            $dispoAh->setReftoMedId($donnees->refto_med_id);
            $dispoAh->setDebut(new DateTime($donnees->start));
            if($donnees->allDay){
                $dispoAh->setFin(new DateTime($donnees->start));
            }else{
                $dispoAh->setFin(new DateTime($donnees->end));
            }
            $dispoAh->setAllDay($donnees->allDay);


            $em = $this->getDoctrine()->getManager();
            $em->persist($dispoAh);
            $em->flush();

            // On retourne le code  ;
            return new Response('Ok', $code);
        }else{
            // Les données sont incomplètes
            return new Response('Données incomplètes', 404);
        }


        return $this->redirectToRoute('dispo_ah_index');
    }



    /**
     * @Route("/{id}/edit1", name="dispo_ah_edit", methods={"GET","POST"})
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
