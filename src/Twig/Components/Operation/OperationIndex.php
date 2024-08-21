<?php

namespace App\Twig\Components\Operation;

use App\Repository\JournalRepository;
use App\Repository\OperationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class OperationIndex extends AbstractController
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(private OperationRepository $repos, private JournalRepository $jouRepos, private RequestStack $req)
    {
        $this->query = $this->req->getCurrentRequest()->getSession()->get('periode');
    }

    public function getOperations()
    {
        $operations = $this->repos->findByQuery($this->query);


        return array_map(function ($ope) {
            $ope->journals = $this->jouRepos->findByOperation($ope->numero);
            return $ope;
        }, $operations);
    }
}
