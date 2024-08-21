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
final class OperationEdit extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use LiveCollectionTrait;

    #[LiveProp()]
    public Operation $ope;

    private function getDataModelValue()
    {
        return 'norender|*';
    }

    protected function instantiateForm(): FormInterface
    {

        // we can extend AbstractController to get the normal shortcuts
        return $this->createForm(OperationType::class, $this->ope);
    }

    #[LiveAction()]
    public function save(
        EntityManagerInterface $em
    ) {
        $this->submitForm();
        $this->ope = $this->form->getData();
        $em->persist($this->ope);
        $em->flush();
        $this->addFlash("success", "تم تعديل العملية بنجاح");
        return $this->redirectToRoute('operation.edit', ['id' => $this->ope->getId()]);
    }
}
