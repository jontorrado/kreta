<?php

namespace Kreta\Component\User\Application\Service;

/**
 * Sign up user request class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class SignUpUserRequest
{
    /**
     * The user email.
     *
     * @var string
     */
    private $email;

    /**
     * The plain password.
     *
     * @var string
     */
    private $plainPassword;

    /**
     * Constructor.
     *
     * @param string $anEmail        The user email
     * @param string $aPlainPassword The user password
     */
    public function __construct($anEmail, $aPlainPassword)
    {
        $this->email = $anEmail;
        $this->plainPassword = $aPlainPassword;
    }

    /**
     * Gets the user email.
     *
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Gets the user plain password.
     *
     * @return string
     */
    public function password()
    {
        return $this->plainPassword;
    }
}
