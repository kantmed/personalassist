<?php

namespace App\Twig\Components\Article;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class ArticleIndex
{
    use DefaultActionTrait;
    
    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private ArticleRepository $repos,private RequestStack $req) 
    {
        $this->query=$req->getCurrentRequest()->getSession()->get('periode');

    }

    public function getArticles()
    {
        return $this->repos->findByQuery($this->query);
    }
}
