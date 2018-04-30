<?php

namespace App\Form;

use App\Controller\ProfileController;
use App\Entity\UserCharCards;
use App\Entity\UserCharDecks;
use App\Entity\UserStat;
use App\Repository\UserCharCardsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class UserCharDeckType extends AbstractType {

    private $security;
    private $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager) {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $user = $this->security->getUser();
        if (!$user) {
            throw new \LogicException(
                'The deck form cannot be used without an authenticated user!'
            );
        }

        $netWorth = ['Bronze' => 1000, 'Silver' => 1500, 'Gold' => 2000, 'Platinum' => 2500, 'Diamond' => 3000, 'Elite' => 3500];
        $userRank = $this->entityManager->getRepository(UserStat::class)->findOneBy(['user' => $user]);
        $rankName = ProfileController::getRankName($userRank->getUserRank());
        //Strip the rank number
        $strippedRankName = substr($rankName, 0, strrpos($rankName, ' '));

        $userNetWorth = $netWorth[$strippedRankName];

        $builder
            ->add('name', TextType::class, ['required' => true]);

        // grab the user, do a quick sanity check that one exists


        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($user) {
                $form = $event->getForm();

                $formOptions = [
                    'class' => UserCharCards::class,
                    'placeholder' => 'cards.choose_card',
                    'translation_domain' => 'cbs',
                    'choice_attr' => function (UserCharCards $cards, $key, $val) {
                        return ['data-networth' => ($cards->getCharCard()->getNetWorth())];
                    },
                    'attr' => ['class' => 'dropdown-select'],
                    'query_builder' => function (UserCharCardsRepository $card) use ($user) {
                        return $card->getUserCards($user);
                    },

                ];

                $form->add('card1', EntityType::class, $formOptions);
                $form->add('card2', EntityType::class, $formOptions);
                $form->add('card3', EntityType::class, $formOptions);
                $form->add('card4', EntityType::class, $formOptions);
                $form->add('card5', EntityType::class, $formOptions);

            }
        );

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => UserCharDecks::class,
        ]);
    }
}
