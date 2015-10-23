<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Infrastructure\File;

use Kreta\Component\Media\Domain\Model\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class SymfonyUploadedFile implements File
{ 
    private $file;
    
    public function __construct(UploadedFile $file) {
        $this->file = $file;
    }

    public function content()
    {
        return file_get_contents($this->file->getPathname());
    }

    public function extension()
    {
        return $this->file->getExtension();
    }
}
