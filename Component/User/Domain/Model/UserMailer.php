<?php

namespace Kreta\Component\User\Domain\Model;

/**
 * User mailer domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
interface UserMailer
{
    /**
     * Mails an email with the given data.
     *
     * @param array $aMailData The data related to build an email
     */
    public function mail(array $aMailData);
}
