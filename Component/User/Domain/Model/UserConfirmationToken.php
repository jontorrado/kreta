<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\User\Domain\Model;

use Ramsey\Uuid\Uuid;

class UserConfirmationToken
{
    /**
     * The id in a primitive type.
     *
     * @var string|int
     */
    private $token;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->token = Uuid::uuid4()->toString();
    }

    /**
     * Gets the id.
     *
     * @return string|int
     */
    public function token()
    {
        return $this->token;
    }

    /**
     * Method that checks if the id given is equal to the current.
     *
     * @param UserConfirmationToken $aToken The token
     *
     * @return bool
     */
    public function equals(UserConfirmationToken $aToken)
    {
        return $this->token() === $aToken->token();
    }

    /**
     * Magic method that represents the token in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->token();
    }
}
