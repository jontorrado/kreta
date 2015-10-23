<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\User\Domain\Model;

/**
 * Email value object that wraps into domain object
 * all the logic related with the email address.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class UserEmail
{
    /**
     * The email in plain string.
     *
     * @var string
     */
    private $email;

    /**
     * The domain of email, for example: "gmail.com"
     *
     * @var string
     */
    private $domain;

    /**
     * The part that exists before the @.
     *
     * @var string
     */
    private $localPart;

    /**
     * Constructor.
     *
     * @param string $anEmail An email in primitive string
     *
     * @throws \InvalidArgumentException when the email is not valid
     */
    public function __construct($anEmail)
    {
        if (!filter_var($anEmail, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException($anEmail);
        }

        $this->email = $anEmail;
        $this->localPart = implode(explode('@', $this->email, -1), '@');
        $this->domain = str_replace($this->localPart . '@', '', $this->email);
    }

    /**
     * Gets the email.
     *
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Gets the local part of email address, for example: "info" into "info@lin3s.com".
     *
     * @return string
     */
    public function localPart()
    {
        return $this->localPart;
    }

    /**
     * Gets the domain of email address, for example: "gmail.com"
     *
     * @return string
     */
    public function domain()
    {
        return $this->domain;
    }

    /**
     * Method that checks if the email given is equal to the current.
     *
     * @param \Kreta\Component\User\Domain\Model\UserEmail $anEmail The email
     *
     * @return bool
     */
    public function equals(UserEmail $anEmail)
    {
        return strtolower((string)$this) === strtolower((string)$anEmail);
    }

    /**
     * Magic method that represents the class in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->email;
    }
}

