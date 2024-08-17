<?php


namespace App\DTO;

use App\Entity\Operation;

class OperationDTO
{
    public string $type;
    public string $coleur;
    public ?float $solde;

    public function __construct(
        public int $id,
        public int $numero,
        int $type,
        public \DateTime $date,
        public ?float $debit,
        public ?float $credit

    ) {
        $this->type = array_search($type, Operation::TYPES);
        $this->coleur = array_search($type, Operation::COLEURS);
        $this->solde = $debit - $credit;
    }
}
