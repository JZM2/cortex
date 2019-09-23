<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FindCustomerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'jméno',
                'required' => false,
            ])
            ->add('surname', TextType::class, [
                'label' => 'příjmení',
                'required' => false,
            ])
            ->add('idc', NumberType::class, [
                'label' => 'číslo karty',
                'required' => false,
            ])
        ;
    }
}