<?php

namespace App\Repository;

use App\Entity\DispoAh;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DispoAh|null find($id, $lockMode = null, $lockVersion = null)
 * @method DispoAh|null findOneBy(array $criteria, array $orderBy = null)
 * @method DispoAh[]    findAll()
 * @method DispoAh[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DispoAhRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DispoAh::class);
    }

    // /**
    //  * @return DispoAh[] Returns an array of DispoAh objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DispoAh
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
