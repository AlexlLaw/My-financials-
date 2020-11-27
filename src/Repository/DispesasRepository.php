<?php

namespace App\Repository;

use App\Entity\Dispesas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dispesas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dispesas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dispesas[]    findAll()
 * @method Dispesas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DispesasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dispesas::class);
    }

    // /**
    //  * @return Dispesas[] Returns an array of Dispesas objects
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
    public function findOneBySomeField($value): ?Dispesas
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
