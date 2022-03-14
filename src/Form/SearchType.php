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
                'label' => 'Barre de recherche',
                 ])
            ->add('Category', EntityType::class,[

                'required'=>false,
                'class'=> Category::class,
                'label' => 'Catégorie',
                'attr' => ['class' => 'form_control mb-4 w-25 d-flex']])
            ->add('nbStars', ChoiceType::class, [

                'choices' => [

                    '⭐' => 1,
                    '⭐⭐' => 2,
                    '⭐⭐⭐' => 3,
                    '⭐⭐⭐⭐' => 4,
                    '⭐⭐⭐⭐⭐' => 5

                ],
                'expanded'=> true,
                'label' => 'Nombre d\'étoiles',
                'multiple' => true,
                'attr' => ['class' => 'form_control my-4 mx-3 px-5 w-100 d-flex flex-column']
            ])
            ->add('prixMin', NumberType::class, [

                'required'=> false,
                'attr'=> ['class' => 'form_control m-3 w-25 align-self-center']

            ])
            ->add('prixMax', NumberType::class, [
                'required'=> false,
                'attr'=> ['class' => 'form_control m-3 w-25']

            ])
            ->add('save', SubmitType::class, [

                'attr'=> ['class' => 'btn btn-success btn-lg mt-5 text-center mx-auto d-flex justify-content-center'],
                'label' => 'Lancer la recherche'

            ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
