<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder->add('email')
            ->add('password')
            ->add('pseudo')
            ->add('roles', TextType::class)
            ->add('level');

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
