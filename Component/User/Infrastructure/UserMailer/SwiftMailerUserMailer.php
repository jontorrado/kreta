<?php

namespace Kreta\Component\User\Infrastructure\UserMailer;

use Kreta\Component\User\Domain\Model\UserMailer;

/**
 * SwiftMailer user mailer class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class SwiftMailerUserMailer implements UserMailer
{
    /**
     * The swift mailer instance.
     *
     * @var \Swift_Mailer
     */
    private $swiftMailer;

    /**
     * Constructor.
     *
     * @param \Swift_Mailer $swiftMailer The swift mailer instance
     */
    public function __construct(\Swift_Mailer $swiftMailer)
    {
        $this->swiftMailer = $swiftMailer;
    }

    /**
     * {@inheritdoc}
     */
    public function mail($aSubject, $from, $to, $aBody)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($aSubject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($aBody);

        $this->swiftMailer->send($message);
    }
}
