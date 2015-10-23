<?php

namespace Kreta\Component\User\Domain\Model;

use Ddd\Domain\DomainEvent;
use Ddd\Domain\Event\PublishableDomainEvent;
use Kreta\Component\User\Model\User;

class UserRegistered implements DomainEvent, PublishableDomainEvent
{
    /**
     * @var UserId
     */
    private $user;

    public function __construct(User $aUser)
    {
        $this->user = $aUser;
        $this->occurredOn = new \DateTime();
    }

    public function user()
    {
        return $this->user;
    }

    /**
     * @return \DateTime
     */
    public function occurredOn()
    {
        return $this->occurredOn;
    }
}

