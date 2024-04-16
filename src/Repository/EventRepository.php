<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function findAllQueryBuilder(): Query
    {
        return $this->createQueryBuilder('event')
                    ->select('event.id, event.name')
                    ->getQuery()
        ;
    }

    public function countAll(): int
    {
        return (int) $this->createQueryBuilder('event')
                    ->select('count(event.id)')
                    ->getQuery()
                    ->getSingleScalarResult()
        ;
    }
}
