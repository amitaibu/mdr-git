<?php

namespace App\Repository;

use App\Entity\ChildMeasurements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ChildMeasurements|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChildMeasurements|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChildMeasurements[]    findAll()
 * @method ChildMeasurements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChildMeasurementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChildMeasurements::class);
    }

    // /**
    //  * @return ChildMeasurements[] Returns an array of ChildMeasurements objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChildMeasurements
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
