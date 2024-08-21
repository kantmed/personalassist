<?php

namespace App\DTO;



class OpeJournalsDTO
{
    public function __construct(
        public ?float $debit,
        public ?float $credit,
        public string $article,
        public ?string $description

    ) {}
}
