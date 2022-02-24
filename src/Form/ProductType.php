<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('description')
            ->add('picture', FileType::class, [
                'mapped'=>false,
                'required'=>true,
                'constraints'=> [

                    new File(
                    [
                    'maxSize'=>'1M',
                    'maxSizeMessage'=> 'Votre fichier est trop lourd (max:2mo).',
                    'mimeTypes'=>['image/jpeg', 'image/jpg', 'image/png'], 'mimeTypesMessage'=> 'Veuillez uploader une image au format jpg ou png, svp.'
                    ])
                                ]
            ])


            ->add('nbStars')
            ->add('id_category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
