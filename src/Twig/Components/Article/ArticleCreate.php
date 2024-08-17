<?php

namespace App\Twig\Components\Article;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent]
final class ArticleCreate extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp()]
    public ?Article $art = null;


    protected function instantiateForm(): FormInterface

    {
        // we can extend AbstractController to get the normal shortcuts
        $form = $this->createForm(ArticleType::class, $this->art);

        return $form;
    }

    #[LiveAction()]
    public function save()
    {
        $this->submitForm();
        $this->art = $this->form->getData();
        dd($this->art);
        $this->addFlash('success', 'تمت العملية بنجاح');
        return $this->redirectToRoute('article.index');
    }
}
