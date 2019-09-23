<?php
/**
 * Created by PhpStorm.
 * User: Honza
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CustomerFormType
 * @package App\Form
 */
class CustomerFormType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idc', NumberType::class, [
                'label' => 'číslo karty',
            ])
            ->add('name', TextType::class, [
                'label' => 'Jméno'
            ])
            ->add('surname', TextType::class, [
                'label' => 'Příjmení'
            ])
            ->add('adress', TextType::class, [
                'label' => 'Adresa'
            ])
            ->add('email', TextType::class, [
                'label' => 'Email'
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Telefon'
            ])
            ;
    }
}