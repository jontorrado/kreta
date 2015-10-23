<?php

namespace Kreta\Component\User\Domain\Event;

use Ddd\Domain\DomainEventSubscriber;
use Kreta\Component\User\Domain\Model\UserMailer;
use Kreta\Component\User\Domain\Model\UserRememberPasswordRequested;

/**
 * User remember password requested subscriber class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class UserRememberPasswordRequestedSubscriber implements DomainEventSubscriber
{
    /**
     * The mailer.
     *
     * @var UserMailer
     */
    private $mailer;

    /**
     * Constructor.
     *
     * @param UserMailer $aMailer The mailer
     */
    public function __construct(UserMailer $aMailer)
    {
        $this->mailer = $aMailer;
    }

    /**
     * @inheritdoc}
     */
    public function handle($aDomainEvent)
    {
        $user = $aDomainEvent->user();

        $this->mailer->mail([
            'subject' => 'Remember password',
            'from'    => '???',
            'to'      => $user->email(),
            'body'    => '???',
        ]);
    }

    /**
     * @inheritdoc}
     */
    public function isSubscribedTo($aDomainEvent)
    {
        return $aDomainEvent instanceof UserRememberPasswordRequested;
    }
}
