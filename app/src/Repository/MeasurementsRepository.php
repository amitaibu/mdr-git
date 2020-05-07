<?php

namespace App\Repository;

use App\Entity\Measurements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Measurements|null find($id, $lockMode = null, $lockVersion = null)
 * @method Measurements|null findOneBy(array $criteria, array $orderBy = null)
 * @method Measurements[]    findAll()
 * @method Measurements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeasurementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Measurements::class);
    }

    // /**
    //  * @return Measurements[] Returns an array of Measurements objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Measurements
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
