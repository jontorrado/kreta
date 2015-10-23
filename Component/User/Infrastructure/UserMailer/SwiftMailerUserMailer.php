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
    public function mail(array $aMailData)
    {
        if (false === array_key_exists('from', $aMailData) || false === array_key_exists('to', $aMailData)) {
            throw new \InvalidArgumentException('From email and to email must be required');
        }
        $subject = array_key_exists('subject', $aMailData) ? $aMailData['subject'] : null;
        $body = array_key_exists('body', $aMailData) ? $aMailData['body'] : null;

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($aMailData['from'])
            ->setTo($aMailData['to'])
            ->setBody($body);

        $this->swiftMailer->send($message);
    }
}
