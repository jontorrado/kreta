<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\User\Domain\Model;

interface UserPasswordEncoder
{
    public function encode($aPlainPassword, $aSalt);
}
