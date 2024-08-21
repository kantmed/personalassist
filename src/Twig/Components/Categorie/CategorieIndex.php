<?php

namespace App\Twig\Components\Categorie;

use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class CategorieIndex
{
    use DefaultActionTrait;
    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private CategorieRepository $repos,private RequestStack $req) {
        $this->query=$req->getCurrentRequest()->getSession()->get('periode');

    }

    public function getCategories()
    {
        return $this->repos->findByQuery($this->query);
    }
}
