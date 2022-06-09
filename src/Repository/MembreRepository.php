<?php

namespace App\Repository;

use App\Entity\Membre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Membre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Membre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Membre[]    findAll()
 * @method Membre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembreRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Membre::class);
    }

    // /**
    //  * @return Membre[] Returns an array of Membre objects
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
    public function findOneBySomeField($value): ?Membre
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOneBySomeField($id)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public function GetListGroupedByName()
    {
        $query=$this->getEntityManager()->createQuery
        ("SELECT a FROM App\Entity\Membre a JOIN a.groupe u ORDER BY u.nom ASC ");
        return $query->getResult();
    }

    public function searchMembersByGroup($groupe){
        //1 er cas : pas de groupe
        if(is_null($groupe)) {
            $query = $this->createQueryBuilder('m')
                ->select('m')
                ->getQuery()->getResult();
        }else {
            //2eme cas : y a un groupe
            $query = $this->createQueryBuilder('m')
                ->select('m')
                ->join('m.groupes', 'g')
                ->where('g.id = :group')
                ->setParameter('group', $groupe)
                ->getQuery()->getResult();
        }

        return $query;
    }
}
