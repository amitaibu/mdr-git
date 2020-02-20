<?php

namespace App\Repository;

use App\Entity\GroupMeeting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GroupMeeting|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupMeeting|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupMeeting[]    findAll()
 * @method GroupMeeting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupMeetingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupMeeting::class);
    }

    // /**
    //  * @return GroupMeeting[] Returns an array of GroupMeeting objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupMeeting
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
