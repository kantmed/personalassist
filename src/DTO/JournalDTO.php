<?php

namespace App\DTO;



class JournalDTO
{
    public function __construct(
        public int $id,
        public int $numero,
        public ?float $debit,
        public ?float $credit,
        public \DateTime $date,
        public string $article,
        public string $categorie,
        public ?string $description

    ) {}
}
