<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\User\Infrastructure\UserPasswordEncoder;

use Kreta\Component\User\Domain\Model\UserPasswordEncoder;

final class Sha512UserPasswordEncoder implements UserPasswordEncoder
{
    /**
     * {@inheritdoc}
     */
    public function encode($aPlainPassword, $aSalt)
    {
        // TODO: Implement encode() method.
    }
}
