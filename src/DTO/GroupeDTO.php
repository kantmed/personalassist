<?php

namespace App\DTO;


class GroupeDTO
{
    public float $solde;

    public function __construct(
        public int $id,
        public string $intitule,
        public float $debit,
        public float $credit,
    ) {
        $this->solde = $debit - $credit;
    }
}
