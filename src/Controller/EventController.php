<?php

namespace App\Controller;

use App\Entity\Event;
use App\OpenApiBundle\Api\EventsApiInterface;
use App\OpenApiBundle\Controller\EventsController;
use App\OpenApiBundle\Model\NewEvent;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/** @phan-suppress PhanUnreferencedClass PhanUnreferencedPublicMethod */
class EventController extends EventsController implements EventsApiInterface
{
    public function __construct(private EntityManagerInterface $entityManager, private EventRepository $eventRepository, private TokenStorageInterface $tokenStorageInterface, private JWTTokenManagerInterface $jwtManager, private Security $security)
    {
    }

    public function createEvent(
        NewEvent $newEvent,
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null {
        $event = new Event();

        $event->setName((string) $newEvent->getName());

        $event->setOwner($this->security->getUser());

        $this->entityManager->persist($event);

        $this->entityManager->flush();

        return $this->serializeEvent($event);
    }

    public function listEvents(
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null {
        $user = $this->security->getUser();

        $count = count($this->eventRepository->findBy(['owner' => $user->getId()]));

        $events = $this->eventRepository->findBy(['owner' => $user->getId()]);

        return [
            'count' => $count,
            'current' => 1,
            'next' => null,
            'previous' => null,
            'items' => array_map([$this, 'serializeEvent'], $events),
        ];
    }

    public function getEvent(
        string $eventUuid,
        int &$responseCode,
        array &$responseHeaders
    ): array|object|null {
        $event = $this->eventRepository->findOneBy(['id' => $eventUuid]);

        if (null === $event) {
            $responseCode = 404;

            return ['message' => 'Event not found'];
        }

        return $this->serializeEvent($event);
    }

    public function setbearerAuth(?string $value): void
    {
    }

    private function serializeEvent(Event $event): array
    {
        return [
            'id' => $event->getId()->toRfc4122(),
            'name' => $event->getName(),
            'owner' => $event->getOwner()->getUsername(),
        ];
    }
}
