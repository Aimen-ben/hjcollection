<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'E-mail',
            'constraints' => [
                new Email([
                    'message' => 'Veuillez saisir une adresse e-mail valide.',
                ]),
                new NotBlank([
                    'message' => 'Veuillez saisir une adresse e-mail.',
                ]),
            ],
        ])
        ->add('lastname', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Nom',
            'constraints' => [
                new Regex([
                    'pattern' => '/^[A-Za-z]+$/',
                    'message' => 'Le nom ne doit contenir que des lettres.',
                ]),
                new NotBlank([
                    'message' => 'Veuillez saisir votre nom.',
                ]),
            ],
        ])
        ->add('firstname', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Prénom',
            'constraints' => [
                new Regex([
                    'pattern' => '/^[A-Za-z]+$/',
                    'message' => 'Le prénom ne doit contenir que des lettres.',
                ]),
                new NotBlank([
                    'message' => 'Veuillez saisir votre prénom.',
                ]),
            ],
        ])
        ->add('address', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Adresse',
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre adresse.',
                ]),
            ],
        ])
        ->add('zipcode', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Code postal',
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre code postal.',
                ]),
                new Length([
                    'min' => 5,
                    'max' => 5,
                    'exactMessage' => 'Le code postal doit comporter exactement {{ limit }} chiffres.',
                ]),
                new Regex([
                    'pattern' => '/^[0-9]+$/',
                    'message' => 'Le code postal ne doit contenir que des chiffres.',
                ]),
            ],
        ])
        ->add('city', TextType::class, [
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Ville',
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir votre ville.',
                ]),
            ],
        ])
        ->add('RGPDConsent', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter nos conditions.',
                ]),
            ],
            'label' => 'En m\'inscrivant à ce site j\'accepte...'
        ])
        ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez saisir un mot de passe.',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères.',
                    // longueur maximale autorisée par Symfony pour des raisons de sécurité
                    'max' => 4096,
                ]),
            ],
            'label' => 'Mot de passe'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
