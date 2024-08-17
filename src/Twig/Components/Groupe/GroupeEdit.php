<?php

namespace App\Twig\Components\Groupe;

use App\Entity\Groupe;
use App\Form\GroupeType;
use App\Repository\GroupeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class GroupeEdit extends AbstractController
{
    use DefaultActionTrait;

    use ComponentWithFormTrait;

    /**
     * The initial data used to create the form.
     */
    #[LiveProp()]
    public ?Groupe $gro = null;


    protected function instantiateForm(): FormInterface

    {
        // we can extend AbstractController to get the normal shortcuts
        $form = $this->createForm(GroupeType::class, $this->gro);

        return $form;
    }

    #[LiveAction()]
    public function save(EntityManagerInterface $em)
    {
        $this->submitForm();
        $this->gro = $this->form->getData();
        $em->persist($this->gro);
        $em->flush();
        $this->addFlash('success', 'تمت العملية بنجاح');
        return $this->redirectToRoute('groupe.index');
    }
}
