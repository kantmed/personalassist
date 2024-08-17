<?php

namespace App\Twig\Components\Groupe;

use App\Repository\GroupeRepository;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class GroupeIndex
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';
    
    public function __construct(private GroupeRepository $repos) {}

    public function getGroupes()
    {
        return $this->repos->findByQuery($this->query);
    }
}
