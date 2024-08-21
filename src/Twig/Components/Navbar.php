<?php

namespace App\Twig\Components;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class Navbar
{

    use DefaultActionTrait;


    public function __construct(private RequestStack $req)
    {
        $this->req->getCurrentRequest()->getSession()->set('periode', '2024-08');
    }
}
