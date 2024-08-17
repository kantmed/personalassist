<?php

namespace App\Twig\Components\Categorie;

use App\Entity\Categorie;
use App\Entity\Groupe;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;

#[AsLiveComponent]
final class CategorieEdit extends AbstractController
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
    public function save(EntityManagerInterface $em)
    {
        $this->submitForm();
        $this->cat = $this->form->getData();
        $em->persist($this->cat);
        $em->flush();
        $this->addFlash('success', 'تمت العملية بنجاح');
        return $this->redirectToRoute('categorie.index');
    }
}
