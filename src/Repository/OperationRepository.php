<?php

namespace App\Repository;

use App\Entity\Operation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Operation>
 */
class OperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operation::class);
    }

    public function findByQuery(string $query): array
    {

        return $this->createQueryBuilder('o')
            ->leftJoin('o.journals', 'j')
            ->select('NEW App\\DTO\\OperationDTO(o.id,o.numero,o.type,o.date,SUM(j.debit),SUM(j.credit))')
            ->where('o.date LIKE :date')
            ->setParameter('date', $query . '%')
            ->groupBy('o.id')
            ->getQuery()
            ->getResult();
    }

    public function findCurrentNumero()
    {
        $operations = $this->findAll();
        $ope = end($operations);
        return $ope->getNumero() + 1;
    }
}
