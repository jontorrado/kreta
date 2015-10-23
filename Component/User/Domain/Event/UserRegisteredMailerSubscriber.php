<?php

namespace Kreta\Component\User\Domain\Event;

use Ddd\Domain\DomainEvent;
use Ddd\Domain\DomainEventSubscriber;
use Kreta\Component\User\Domain\Model\UserMailer;
use Kreta\Component\User\Domain\Model\UserRegistered;

final class UserRegisteredMailerSubscriber implements DomainEventSubscriber
{
    private $mailer;
    
    public function __construct(UserMailer $mailer) 
    {
        $this->mailer = $mailer;
    }

    /**
     * @param DomainEvent $aDomainEvent
     */
    public function handle($aDomainEvent)
    {
        $user = $aDomainEvent->user();
        
        $this->mailer->mail($user->email(), 'Registered successfully');
    }

    /**
     * @param DomainEvent $aDomainEvent
     *
     * @return bool
     */
    public function isSubscribedTo($aDomainEvent)
    {
        return $aDomainEvent instanceof UserRegistered;
    }
}
