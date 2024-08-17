<?php

namespace App\Twig\Components\Categorie;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[AsLiveComponent]
final class CategorieCreate extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp()]
    public ?Categorie $cat = null;


    protected function instantiateForm(): FormInterface

    {
        // we can extend AbstractController to get the normal shortcuts
        $form = $this->createForm(CategorieType::class, $this->cat);

        return $form;
    }

    #[LiveAction()]
    public function save()
    {
        $this->submitForm();
        $this->cat = $this->form->getData();
        dd($this->cat);
        $this->addFlash('success', 'تمت العملية بنجاح');
        return $this->redirectToRoute('categorie.index');
    }
}
