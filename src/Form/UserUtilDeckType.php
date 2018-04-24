<?php

namespace App\Form;

use App\Entity\UserUtilCards;
use App\Entity\UserUtilDecks;
use App\Repository\UserUtilCardsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class UserUtilDeckType extends AbstractType
{
    private $security;

    public function __construct(Security $security) {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', TextType::class, [
                'required' => true
            ]);

        // grab the user, do a quick sanity check that one exists
        $user = $this->security->getUser();
        if (!$user) {
            throw new \LogicException(
                'The deck form cannot be used without an authenticated user!'
            );
        }

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($user) {
                $form = $event->getForm();

                $formOptions = [
                    'class' => UserUtilCards::class,
                    'placeholder'=>'cards.choose_card',
                    'translation_domain'=>'cbs',
                    'query_builder' => function (UserUtilCardsRepository $card) use ($user) {
                        return $card->getUserCards($user);
                    },

                ];

                $form->add('card1', EntityType::class, $formOptions);
                $form->add('card2', EntityType::class, $formOptions);
                $form->add('card3', EntityType::class, $formOptions);


            }
        );


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserUtilDecks::class,
        ]);
    }
}
