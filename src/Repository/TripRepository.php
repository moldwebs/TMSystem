<?php


namespace App\Repository;


use App\Entity\Options\Route;
use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TripRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }

    public function getMaxNumber()
    {
        return $this->createQueryBuilder('q')
            ->select('MAX(q.number)')
            ->getQuery()
            ->getSingleScalarResult()
            ;
    }

    public function getLast(Route $route)
    {
        return $this->createQueryBuilder('q')
            ->andWhere("q.route = :route")
            ->setParameter("route", $route)
            ->orderBy('q.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
