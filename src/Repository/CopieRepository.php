<?php

namespace App\Repository;

use App\Entity\Copie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Copie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Copie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Copie[]    findAll()
 * @method Copie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CopieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Copie::class);
    }

    // /**
    //  * @return Copie[] Returns an array of Copie objects
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
    public function findOneBySomeField($value): ?Copie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function searchCopiesByouvrage($ouvrage){
        //1 er cas : pas de ouvrage
        if(is_null($ouvrage)) {
            $query = $this->createQueryBuilder('m')
                ->select('m')
                ->getQuery()->getResult();
        }else {
            //2eme cas : y a un ouvrage
            $query = $this->createQueryBuilder('m')
                ->select('m')
                ->join('m.ouvrages', 'g')
                ->where('g.id = :ouvrages')
                ->setParameter('ouvrages', $ouvrage)
                ->getQuery()->getResult();
        }

        return $query;
    }




}
