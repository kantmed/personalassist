<?php

namespace App\Twig\Components\Article;

use App\Entity\Article;
use App\Entity\Groupe;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent]
final class ArticleEdit extends AbstractController
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
    public function save(EntityManagerInterface $em)
    {
        $this->submitForm();
        $this->art = $this->form->getData();
        $em->persist($this->art);
        $em->flush();
        $this->addFlash('success', 'تمت العملية بنجاح');
        return $this->redirectToRoute('article.index');
    }
}
