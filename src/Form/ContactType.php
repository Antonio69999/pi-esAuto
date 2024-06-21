<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'nom',
                TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'nom',
                    ]
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'email',
                    ]
                ]
            )
            ->add('immatriculation', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder'   => "immatriculation",
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Z]{2}-\d{3}-[A-Z]{2}$/',
                        'message' => 'L\'immatriculation doit être sous le format XX-123-XX',
                    ]),
                ],
            ])
            ->add('sujet', TextType::class, [
                'required' => true,
                'attr' => [
                    'placeholder'   => "sujet du message",
                ]
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'placeholder'   => "message",
                ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Envoyer']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // $resolver->setDefaults([
        //     //'data_class' => Contact::class,
        //     'constraints' => [
        //         new Regex([
        //             'pattern' => '/^[A-Z]{2}-\d{3}-[A-Z]{2}$/',
        //             'message' => 'The immatriculation should have the format XX-123-XX.',
        //         ]),
        //     ],
        // ]);
    }
}
