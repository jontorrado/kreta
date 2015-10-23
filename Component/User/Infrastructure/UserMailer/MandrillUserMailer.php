<?php

namespace Kreta\Component\User\Infrastructure\UserMailer;

use Kreta\Component\User\Domain\Model\UserMailer;

/**
 * Mandrill user mailer class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class MandrillUserMailer implements UserMailer
{
    /**
     * The mandrill instance.
     *
     * @var \Mandrill
     */
    private $mandrill;

    /**
     * Constructor.
     *
     * @param \Mandrill $mandrill The mandrill instance
     */
    public function __construct(\Mandrill $mandrill)
    {
        $this->mandrill = $mandrill;
    }

    /**
     * {@inheritdoc}
     */
    public function mail(array $aMailData)
    {
        // TODO: Implement mail() method.
    }
}
