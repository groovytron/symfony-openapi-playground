<?php
namespace App\Controller;

use App\OpenApiBundle\Controller\EventsController;
use App\OpenApiBundle\Api\EventsApiInterface;
use App\Pagination\ApiPagination;
use App\Repository\EventRepository;
use App\Entity\Event;
use App\OpenApiBundle\Model\NewEvent;

use Doctrine\ORM\EntityManagerInterface;

/** @phan-suppress PhanUnreferencedClass PhanUnreferencedPublicMethod */
class EventController extends EventsController implements EventsApiInterface
{
    public function __construct(private EntityManagerInterface $entityManager, private EventRepository $eventRepository) { }

    public function createEvent(
        NewEvent $newEvent,
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null
    {
        $event = new Event();

        $event->setName((string) ($newEvent->getName()));

        $this->entityManager->persist($event);

        $this->entityManager->flush();

        return $event;
    }

    public function listEvents(
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null
    {
        $count = $this->eventRepository->countAll();
        $events = $this->eventRepository->findAll();

        $pagination = new ApiPagination(
            $count, 2, 3, 1, $events
        );

        return $pagination;
    }
}
