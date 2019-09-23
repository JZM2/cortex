<?php

namespace App\Repository;

use App\Entity\ReportTopCustomers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReportTopCustomers|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportTopCustomers|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportTopCustomers[]    findAll()
 * @method ReportTopCustomers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportTopCustomersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportTopCustomers::class);
    }

    // /**
    //  * @return ReportTopCustomers[] Returns an array of ReportTopCustomers objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReportTopCustomers
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
