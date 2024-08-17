<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }


    public function findByQuery(string $query): array
    {


        return $this->createQueryBuilder('a')
            ->leftJoin('a.journals', 'j')
            ->leftJoin('j.operation', 'o')
            ->select('NEW App\\DTO\\ArticleDTO(a.id,a.intitule,SUM(j.debit),SUM(j.credit))')
            ->where('o.date LIKE :date')
            ->setParameter('date', $query . '%')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
    }
}
