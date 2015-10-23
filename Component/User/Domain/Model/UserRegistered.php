<?php

namespace Kreta\Component\User\Domain\Model;

use Ddd\Domain\DomainEvent;
use Ddd\Domain\Event\PublishableDomainEvent;
use Kreta\Component\User\Model\User;

/**
 * User registered domain event class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class UserRegistered implements DomainEvent, PublishableDomainEvent
{
    /**
     * The user.
     *
     * @var User
     */
    private $user;

    /**
     * Constructor.
     *
     * @param User $aUser The user
     */
    public function __construct(User $aUser)
    {
        $this->user = $aUser;
        $this->occurredOn = new \DateTime();
    }

    /**
     * Gets the user.
     *
     * @return User
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Gets the occurred on.
     *
     * @return \DateTime
     */
    public function occurredOn()
    {
        return $this->occurredOn;
    }
}
