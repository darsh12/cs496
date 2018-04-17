<?php

namespace App\Form;

use App\Entity\UserCharDecks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCharDeckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required'=>true
            ])
            ->add('card1', EntityType::class, [
                'class' => 'App\Entity\UserCharCards',
                'placeholder'=>'Choose card',
                'label'=>'Card 1'
                ])
            ->add('card2', EntityType::class, [
                'class' => 'App\Entity\UserCharCards',
                'placeholder'=>'Choose card',
                'label'=>'Card 2'
            ])
            ->add('card3', EntityType::class, [
                'class' => 'App\Entity\UserCharCards',
                'placeholder'=>'Choose card',
                'label'=>'Card 3'
            ])
            ->add('card4', EntityType::class, [
                'class' => 'App\Entity\UserCharCards',
                'placeholder'=>'Choose card',
                'label'=>'Card 4'
            ])
            ->add('card5', EntityType::class, [
                'class' => 'App\Entity\UserCharCards',
                'placeholder'=>'Choose card',
                'label'=>'Card 5'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserCharDecks::class,
        ]);
    }
}
