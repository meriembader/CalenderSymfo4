<?php

namespace App\Repository;

use App\Entity\SispoA;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SispoA|null find($id, $lockMode = null, $lockVersion = null)
 * @method SispoA|null findOneBy(array $criteria, array $orderBy = null)
 * @method SispoA[]    findAll()
 * @method SispoA[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SispoARepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SispoA::class);
    }

    // /**
    //  * @return SispoA[] Returns an array of SispoA objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SispoA
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
