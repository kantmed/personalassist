<?php

namespace App\Repository;

use App\Entity\Groupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Groupe>
 */
class GroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupe::class);
    }

    public function findByQuery(string $query): array
    {


        return $this->createQueryBuilder('g')
            ->leftJoin('g.categories', 'c')
            ->leftJoin('c.articles', 'a')
            ->leftJoin('a.journals', 'j')
            ->leftJoin('j.operation', 'o')
            ->select('NEW App\\DTO\\GroupeDTO(g.id,g.intitule,SUM(j.debit),SUM(j.credit),o.date)')
            ->where('o.date LIKE :date')
            ->setParameter('date', $query . '%')
            ->groupBy('g.id')
            ->getQuery()
            ->getResult();
    }
    //    /**
    //     * @return Groupe[] Returns an array of Groupe objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Groupe
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
