<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login', TextType::class, $this->getConfiguration( 'Login', "Saisir lelgin de l'utilisateur"))
            ->add('hash', PasswordType::class, $this->getConfiguration('Login', "Saisir le mot de passe de l'utilisateur"))
            ->add('userRoles', EntityType::class, $this->getConfiguration("Niveau d'accès", "Choisir le niveau d'accès ", [
                'class' => Role::class,
                'choice_label' => 'title',
                'multiple' => true,
                'placeholder' => "Choisir le niveau d'accès ...",
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
