<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/article', name: 'article.')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('article/index.html.twig');
    }

    #[Route('/create', name: 'create')]
    public function create(): Response
    {
        return $this->render('article/create.html.twig');
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Article $art): Response
    {
        return $this->render('article/edit.html.twig',compact('art'));
    }
}
