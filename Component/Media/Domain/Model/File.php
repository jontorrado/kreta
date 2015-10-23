<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\Media\Domain\Model;


interface File
{
    public function content();
    
    public function extension();
}
