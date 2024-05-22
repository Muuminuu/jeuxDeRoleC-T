<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '180',
                ],
                'label' => 'Adresse email',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min' => 2, 'max' => 180]),
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control',
                ],
                    'label' => 'Mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Confirmer votre mot de passe',
                    'label_attr' => [
                        'class' => 'form-label mt-4'
                    ],
                ],
                'invalid_message' => 'Les deux mots de passe doivent correspondre.',
            ])
            ->add('pseudo', TextType::class)
            ->add('roles', TextType::class)
            // ->add('roles', CheckboxType::class, [
            //     'label' => 'Rôles',
            //     'required' => false,
            // ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ]);

    $builder->get('roles')
        ->addModelTransformer(new CallbackTransformer(
            function ($tagsAsArray): string {
                // transform the array to a string
                return implode(', ', $tagsAsArray);
            },
            function ($tagsAsString): array {
                // transform the string back to an array
                return explode(', ', $tagsAsString);
            }
        ))
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
