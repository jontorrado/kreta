<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Application\Service\Media;

use Ddd\Application\Service\ApplicationService;
use Gaufrette\Filesystem;
use Kreta\Component\Media\Application\Service\Media\UploadMediaRequest;

class UploadMediaService implements ApplicationService
{
    protected $filesystem;
    
    public function __construct(FilesystemInterface $filesystem) {
        $this->filesystem = $filesystem;    
    }
    
    public function execute($request) {
        $media = $request->media();
        $name = $request->name();
        
        if (!$media->hasMedia()) {
            return;
        }

        if (null !== $media->getName()) {
            $this->remove($media->getName());
        }

        do {
            $hash = md5(uniqid(mt_rand(), true));
        } while ($this->filesystem->has($name));

        $media->setName($name);

        if ($test === false) {
            $this->filesystem->write(
                $media->getName(),
                file_get_contents($media->getMedia()->getPathname())
            );
        }
    }
}
