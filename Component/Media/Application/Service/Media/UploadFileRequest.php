<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\Media\Application\Service\Media;


use Kreta\Component\Media\Domain\Model\File;

class UploadFileRequest
{
    protected $file;
    
    protected $name;
    
    public function __construct(File $file, $name) {
        $this->file = $file;
    }
    
    public function file()
    {
        return $this->file;
    }
    
    public function name() 
    {
        return $this->name;
    }
}
