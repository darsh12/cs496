<?php

namespace App\Form;

use App\Entity\CustomCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('char_name', TextType::class, array(
                'label' => 'Name'
            ))
            ->add('char_type', ChoiceType::class, array(
                'label' => 'Type',
                'placeholder' => 'Select Type',
                'choices' => array(
                    'Action' => 'Action',
                    'Comedy' => 'Comedy',
                    'Drama' => 'Drama',
                )
            ))
            ->add('char_class', ChoiceType::class, array(
                'label' => 'Class',
                'placeholder' => 'Select Class',
                'choices' => array(
                    'DPS' => 'DPS',
                    'Tank' => 'Tank',
                )
            ))
            ->add('char_tier', ChoiceType::class, array(
                'label' => 'Tier',
                'placeholder' => 'Select Tier',
                'choices' => array(
                    'Amateur' => 'Amateur',
                    'Professional' => 'Professional',
                    'World Star' => 'World Star',
                )
            ))
            ->add('image_file', FileType::class, array(
                'label' => 'Upload Image (jpeg, gif, png)'
            ))
            ->add('attack', RangeType::class, array(
                'attr' => array(
                    'min' => 50,
                    'max' => 99,
                )
            ))
            ->add('defense', RangeType::class, array(
                'attr' => array(
                    'min' => 50,
                    'max' => 99
                )
            ))
            ->add('hitpoints', RangeType::class, array(
                'attr' => array(
                    'min' => 50,
                    'max' => 99
                )
            ))
            ->add('luck', RangeType::class, array(
                'attr' => array(
                    'min' => 50,
                    'max' => 99
                )
            ))
            ->add('agility', RangeType::class, array(
                'attr' => array(
                    'min' => 50,
                    'max' => 99
                )
            ))
            ->add('speed', RangeType::class, array(
                'attr' => array(
                    'min' => 1,
                    'max' => 9
                )
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomCard::class,
        ]);
    }
}
