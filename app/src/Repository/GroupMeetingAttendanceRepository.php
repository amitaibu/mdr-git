<?php

namespace App\Repository;

use App\Entity\GroupMeetingAttendance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GroupMeetingAttendance|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupMeetingAttendance|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupMeetingAttendance[]    findAll()
 * @method GroupMeetingAttendance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupMeetingAttendanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupMeetingAttendance::class);
    }

    // /**
    //  * @return GroupMeetingAttendance[] Returns an array of GroupMeetingAttendance objects
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
    public function findOneBySomeField($value): ?GroupMeetingAttendance
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
