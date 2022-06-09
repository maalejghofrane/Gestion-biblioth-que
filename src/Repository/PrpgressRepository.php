<?php

namespace App\Repository;

use App\Entity\Prpgress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Prpgress|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prpgress|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prpgress[]    findAll()
 * @method Prpgress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrpgressRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Prpgress::class);
    }

    // /**
    //  * @return Prpgress[] Returns an array of Prpgress objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prpgress
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
