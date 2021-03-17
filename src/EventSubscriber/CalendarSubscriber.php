<?php

namespace App\EventSubscriber;

use App\Repository\DispoAhRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $DispoAhRepository;
    private $router;

    public function __construct(
        DispoAhRepository $dispoAhRepository,
        UrlGeneratorInterface $router
    ) {
        $this->dispoAhRepository = $dispoAhRepository;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // Modify the query to fit to your entity and needs
        // Change dispoAh.beginAt by your start date property
        $dispoAhs = $this->dispoAhRepository
            ->createQueryBuilder('dispoAh')
            ->where('dispoAh.debut BETWEEN :start and :end OR dispoAh.fin BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult()
        ;

        foreach ($dispoAhs as $dispoAh) {
            // this create the events with your data (here dispoAh data) to fill calendar
            $dispoAhEvent = new Event(
                $dispoAh->getReftoMedId(),
                $dispoAh->getTitre(),
                $dispoAh->getDebut(),
                $dispoAh->getFin(),
                $dispoAh->getDescp(),
                $dispoAh->getAllDay()// If the end date is null or not defined, a all day event is created.
            );

            /*
             * Add custom options to events
             *
             * For more information see: https://fullcalendar.io/docs/event-object
             * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
             */

            $dispoAhEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
            $dispoAhEvent->addOption(
                'url',
                $this->router->generate('dispoAh_show', [
                    'id' => $dispoAh->getId(),
                ])
            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($dispoAhEvent);
        }
    }
}