<?php

namespace App\Form;

use App\Entity\Operation;
use App\Repository\OperationRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class OperationType extends AbstractType
{
    public function __construct(private OperationRepository $repos)
    {
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('numero', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => Operation::TYPES,
                'choice_label' => function ($key, $value) {
                    return $value;
                },
                'expanded' => true,
                'action' => 'prevent',
                'label_attr' => ['class' => 'radio-inline']



            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'format' => 'yyyy-MM-dd',
                'action' => 'prevent'
            ])

            ->add('journals', LiveCollectionType::class, [
                'entry_type' => JournalType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
        ]);
    }
}
