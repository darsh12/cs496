<?php

namespace App\EventSubscriber;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class RedirectAfterRegistrationConfirmSubscriber implements EventSubscriberInterface {
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router) {

        $this->router = $router;
    }

    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::REGISTRATION_CONFIRM => ['onFosUserRegistrationConfirmed'],
        ];
    }

    public function onFosUserRegistrationConfirmed(GetResponseUserEvent $event) {
        $url = $this->router->generate('app_homepage');
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }
}
