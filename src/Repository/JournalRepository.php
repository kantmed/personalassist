<?php

namespace App\Repository;

use App\Entity\Journal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Journal>
 */
class JournalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Journal::class);
    }

    public function findByOperation($numero)
     { 
        return $this->createQueryBuilder('j')
        ->leftJoin('j.operation','o')
        ->leftJoin('j.article','a')
        ->select('NEW App\\DTO\\OpeJournalsDTO(j.debit,j.credit,a.intitule,j.description)')
        ->where('o.numero = :numero')
        ->setParameter('numero',$numero)
        ->getQuery()
        ->getResult()
        ;
        
    }

}
