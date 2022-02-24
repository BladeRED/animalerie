<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class, ['attr' => ['class' => 'form_control m-4 w-50']] )
            ->add('price', NumberType::class,['attr' => ['class' => 'form_control m-4 w-50']])
            ->add('description',TextType::class, ['attr' => ['class' => 'form_control m-4 w-50']])
            ->add('picture', FileType::class, [
                'mapped'=>false,
                'required'=>true,
                'attr' => ['class' => 'form_control m-4 w-50'],
                'constraints'=> [

                    new File(
                    [
                    'maxSize'=>'1M',
                    'maxSizeMessage'=> 'Votre fichier est trop lourd (max:2mo).',
                    'mimeTypes'=>['image/jpeg', 'image/jpg', 'image/png'], 'mimeTypesMessage'=> 'Veuillez uploader une image au format jpg ou png, svp.'
                    ])
                                ]
            ])


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
                'attr' => ['class' => 'form_control m-3 w-50']])
            ->add('id_category', EntityType::class,[

                'required'=>false,
                'class'=> Category::class,
                'attr' => ['class' => 'form_control m-4 w-50']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
