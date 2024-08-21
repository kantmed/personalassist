<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\PdfGenerateur;
use Dompdf\Dompdf;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

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
        return $this->render('article/edit.html.twig', compact('art'));
    }

    #[Route('/pdf', name: 'pdf')]
    public function pdf(
        ArticleRepository $repos,
        Request $req,
        PdfGenerateur $pdf
    ): Response {
        $periode = $req->getSession()->get('periode');
        $articles = $repos->findByQuery($periode);
        $html = $this->renderView('article/pdf.html.twig', compact('periode','articles'));
        $content = $pdf->output($html);
        return new Response($content, 200, [
            'Content-Type' => 'application/pdf'
        ]);
    }
}
