<?php

namespace App\Form;

use App\Entity\Classmate;
use App\Form\Type\StatesType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("classmate", EntityType::class, [
                'placeholder' => 'Choose an classmate',
                "class" => Classmate::class,
                "choice_label" => function ($classmate) {
                    /** @var $classmate Classmate */
                    return $classmate->__toString();
                },
                'required' => false
            ])
            ->add("current_name", null, [
                'label' => 'Current Name',
                'required'   => false,
            ])
            ->add("significant_other", null, [
                'label' => 'Significant Other',
                'required'   => false,
            ])
            ->add("email", EmailType::class, [
                'required'   => true,
            ])
            ->add("phone", null, [
                'required'   => false,
            ])
            ->add("address_1", null, [
                'label' => 'Address',
                'required'   => false,
            ])
            ->add("address_2", null, [
                'label' => 'Suite/Apt',
                'required'   => false,
            ])
            ->add("city", null, [
                'required'   => false,
            ])
            ->add("state", StatesType::class, [
                'required'   => false,
            ])
            ->add("zip", null, [
                'required'   => false,
            ])
            ->add("info_string", TextareaType::class, [
                'label' => 'Comments',
                'required'   => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
