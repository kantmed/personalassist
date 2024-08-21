<?php

namespace App\Controller;

use App\Entity\Operation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/operation', name: 'operation.')]
class OperationController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('operation/index.html.twig');
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('operation/create.html.twig');
    }

    #[Route('/edit{id}', name: 'edit')]
    public function edit(Operation $ope): Response
    {
        return $this->render('operation/edit.html.twig', compact('ope'));
    }
}
