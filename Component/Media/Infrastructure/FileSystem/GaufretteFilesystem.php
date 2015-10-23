<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Infrastructure\Filesystem;

use Domain\Model\Filesystem;
use Gaufrette\Filesystem as Gaufrette;

class GaufretteFilesystem implements Filesystem
{
    /**
     * @var \Infrastructure\Filesystem\GaufretteFilesystem
     */
    private $filesystem;

    public function __construct(Gaufrette $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function write($path, $content)
    {
        $this->filesystem->write($path, $content);
    }

    public function remove($path)
    {
        $this->filesystem->remove($path);
    }
}
