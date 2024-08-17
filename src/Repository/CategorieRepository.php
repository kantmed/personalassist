<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categorie>
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    
    public function findByQuery(string $query): array
    {


        return $this->createQueryBuilder('c')
            ->leftJoin('c.articles', 'a')
            ->leftJoin('a.journals', 'j')
            ->leftJoin('j.operation', 'o')
            ->select('NEW App\\DTO\\GroupeDTO(c.id,c.intitule,SUM(j.debit),SUM(j.credit))')
            ->where('o.date LIKE :date')
            ->setParameter('date', $query . '%')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Categorie[] Returns an array of Categorie objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Categorie
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
