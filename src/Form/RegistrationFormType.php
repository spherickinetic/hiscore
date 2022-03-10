<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameFirst', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'First Name',
                    'minlength' => 2,
                    'maxlength' => 255
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                    ]),
                ],
            ])
            ->add('nameLast', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Last Name',
                    'minlength' => 2,
                    'maxlength' => 255
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'autocomplete' => 'email',
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Email',
                    'minlength' => 2,
                    'maxlength' => 255
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                    ]),
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                'label' => false,
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',                     
                    'class' => 'bg-transparent block mt-10 mx-auto border-b-2 w-1/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Password',
                    'minlength' => 6,
                    'maxlength' => 4096
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 6,
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}