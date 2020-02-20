<?php

namespace App\Repository;

use App\Entity\GroupMeetingAttendanceList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GroupMeetingAttendanceList|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupMeetingAttendanceList|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupMeetingAttendanceList[]    findAll()
 * @method GroupMeetingAttendanceList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupMeetingAttendanceListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupMeetingAttendanceList::class);
    }

    // /**
    //  * @return GroupMeetingAttendanceList[] Returns an array of GroupMeetingAttendanceList objects
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
    public function findOneBySomeField($value): ?GroupMeetingAttendanceList
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
