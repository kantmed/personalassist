<?php

namespace App\Twig\Components\Article;

use App\Repository\ArticleRepository;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class ArticleIndex
{
    use DefaultActionTrait;
    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private ArticleRepository $repos) {}

    public function getArticles()
    {
        return $this->repos->findByQuery($this->query);
    }
}
