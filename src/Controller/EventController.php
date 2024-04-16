<?php

namespace App\Controller;

use App\Entity\Event;
use App\OpenApiBundle\Api\EventsApiInterface;
use App\OpenApiBundle\Controller\EventsController;
use App\OpenApiBundle\Model\NewEvent;
use App\Pagination\ApiPagination;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/** @phan-suppress PhanUnreferencedClass PhanUnreferencedPublicMethod */
class EventController extends EventsController implements EventsApiInterface
{
    public function __construct(private EntityManagerInterface $entityManager, private EventRepository $eventRepository, private TokenStorageInterface $tokenStorageInterface, private JWTTokenManagerInterface $jwtManager)
    {
    }

    public function createEvent(
        NewEvent $newEvent,
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null {
        $event = new Event();

        $event->setName((string) $newEvent->getName());

        $this->entityManager->persist($event);

        $this->entityManager->flush();

        return $event;
    }

    public function listEvents(
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null {
        $count = $this->eventRepository->countAll();
        $events = $this->eventRepository->findAll();

        $pagination = new ApiPagination(
            $count, 1, null, null, $events
        );

        return $pagination;
    }

    public function setbearerAuth(?string $value): void
    {
    }
}
