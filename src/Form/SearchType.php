<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('searchBar', TextType::class, [
                'required'=> false,
                'attr'=> ['class' => 'form_control m-3 w-50'] ])
            ->add('Category', EntityType::class,[

                'required'=>false,
                'class'=> Category::class,
                'attr' => ['class' => 'form_control m-4 w-50']])
            ->add('nbStars', ChoiceType::class, [

                'choices' => [

                    '1 étoile' => 1,
                    '2 étoiles' => 2,
                    '3 étoiles' => 3,
                    '4 étoiles' => 4,
                    '5 étoiles' => 5

                ],
                'expanded'=> true,
                'multiple' => true,
                'attr' => ['class' => 'form_control m-3 w-50']
            ])
            ->add('prixMin', NumberType::class, [

                'required'=> false,
                'attr'=> ['class' => 'form_control m-3 w-50']

            ])
            ->add('prixMax', NumberType::class, [
                'required'=> false,
                'attr'=> ['class' => 'form_control m-3 w-50']

            ])
            ->add('save', SubmitType::class, [

                'attr'=> ['class' => 'btn btn-success btn-lg mt-5']

            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
