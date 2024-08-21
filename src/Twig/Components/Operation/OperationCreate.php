<?php

namespace App\Twig\Components\Operation;

use App\Entity\Operation;
use App\Form\OperationType;
use App\Repository\OperationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent]
final class OperationCreate extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use LiveCollectionTrait;

    #[LiveProp()]
    public ?Operation $ope = null;

    public function __construct(private OperationRepository $repos)
    {
        $this->ope = new Operation;
    }

    public function getDataModelValue(): ?string
    {
        return 'norender|*';
    }


    protected function instantiateForm(): FormInterface

    {
        $this->ope->setNumero($this->repos->findCurrentNumero());
        $this->ope->setDate(new \DateTime);

        // we can extend AbstractController to get the normal shortcuts
        $form = $this->createForm(OperationType::class, $this->ope);

        return $form;
    }

    #[LiveAction()]
    public function save(EntityManagerInterface $em)
    {
        $this->submitForm();
        $this->ope = $this->form->getData();
        $em->persist($this->ope);
        $em->flush();
        $this->addFlash('success', 'تمت العملية بنجاح');
        return $this->redirectToRoute('operation.index');
    }
}
