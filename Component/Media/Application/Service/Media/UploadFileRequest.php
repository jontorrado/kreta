<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\Media\Application\Service\Media;


class UploadFileRequest
{
    public function __construct(FileInterface $file, $name) {
        $this->file = $file;
    }
    
    public function media()
    {
        return $this->media;
    }
}
