<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Journal;
use App\Entity\Operation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JournalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('debit', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'المدين'
                ]

            ])
            ->add('credit', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'الدائن'
                ]

            ])
            ->add('description', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'التبرير'
                ]

            ])
            ->add('createdAt')
            ->add('updatedAt')
            ->add('article', EntityType::class, [
                'class' => Article::class,
                'placeholder' => 'اختر من القائمة',
                'autocomplete' => true,
                'label' => false,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Journal::class,
        ]);
    }
}
