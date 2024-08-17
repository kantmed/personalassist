<?php

namespace App\Controller;

use App\Entity\Groupe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/groupe', name: 'groupe.')]
class GroupeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('groupe/index.html.twig');
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('groupe/create.html.twig');
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Groupe $gro): Response
    {
        return $this->render('groupe/edit.html.twig',compact('gro'));
    }
}
