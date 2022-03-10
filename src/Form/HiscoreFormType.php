<?php

namespace App\Form;

use App\Entity\Difficulty;
use App\Entity\Hiscore;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class HiscoreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('difficulty', EntityType::class,[
                'label' => false,
                'attr' => [
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Select difficulty'
                ],
                'class' => Difficulty::class,
                'choice_label' => 'title',
                'placeholder' => 'Select difficulty',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('score', IntegerType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Add high score',
                    'min' => 0,
                    'max' => 99999
                ],
                'constraints' => [
                    new NotBlank(),
                    new Range([
                        'min' => 0,
                        'max' => 99999,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hiscore::class,
        ]);
    }
}
