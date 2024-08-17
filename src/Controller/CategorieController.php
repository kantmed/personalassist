<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/categorie', name: 'categorie.')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig');
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('categorie/create.html.twig');
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Categorie $cat): Response
    {
        return $this->render('categorie/edit.html.twig',compact('cat'));
    }
}
