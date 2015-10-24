<?php

namespace Kreta\Component\User\Application\Service;

/**
 * Sign up user request class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class LogInUserRequest
{
    /**
     * The user id.
     *
     * @var string
     */
    private $id;

    /**
     * The user plain password.
     *
     * @var string
     */
    private $plainPassword;

    /**
     * Constructor.
     *
     * @param string $anId           The user id
     * @param string $aPlainPassword The user plain password
     */
    public function __construct($anId, $aPlainPassword)
    {
        $this->id = $anId;
        $this->plainPassword = $aPlainPassword;
    }

    /**
     * Gets the user id.
     *
     * @return string
     */
    public function id()
    {
        return $this->id;
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
