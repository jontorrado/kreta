<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\User\Domain\Model;

use Rhumsaa\Uuid\Uuid;

/**
 * City id value object class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
final class UserId
{
    /**
     * The id in a primitive type.
     *
     * @var string|int
     */
    private $id;

    /**
     * Constructor.
     *
     * @param string|int|null $anId The id in a primitive type
     */
    public function __construct($anId = null)
    {
        $this->id = null === $anId ? Uuid::uuid4()->toString() : $anId;
    }

    /**
     * Gets the id.
     *
     * @return string|int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Method that checks if the id given is equal to the current.
     *
     * @param UserId $anId The id
     *
     * @return bool
     */
    public function equals(UserId $anId)
    {
        return $this->id() === $anId->id();
    }

    /**
     * Magic method that represents the city id in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->id();
    }
}
