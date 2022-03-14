<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> 'Email','attr'=>['class' => 'd-flex justify-content-center my-2'],

            ])
            ->add('birthdate', DateType::class, [
                'label'=> 'Date de naissance','attr'=>['class' => 'd-flex justify-content-center my-2'],
                'widget' => 'single_text',
                'html5'=> 'true'


            ])
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message'=> 'Vérifiez votre mot de passe, svp',
                'options'=>['attr'=>['class' => 'password_field my-3 mx-5']],
                'required'=> true,
                'first_options'=>['label' => 'Mot de passe', 'attr'=>['class' => 'd-flex justify-content-center my-2']],
                'second_options'=>['label'=> 'Confirmez votre mot de passe',  'attr'=>['class' => 'd-flex justify-content-center my-2']],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous n\'avez saisi aucun mot de passe. ',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
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
