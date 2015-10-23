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
use Domain\Model\FileReferenceRepository;
use Domain\Model\Filesystem;
use Kreta\Component\Media\Application\Service\Media\UploadMediaRequest;
use Kreta\Component\Media\Model\FileReference;
use Kreta\Component\Media\Model\Media;

class UploadMediaService implements ApplicationService
{
    protected $filesystem;
    
    /**
     * @var \Domain\Model\FileReferenceRepository
     */
    private $repository;

    public function __construct(Filesystem $filesystem, FileReferenceRepository $repository)
    {
        $this->filesystem = $filesystem;
        $this->repository = $repository;
    }

    public function execute($request = null)
    {
        $file = $request->file();
        $filename = $request->filename();

        $this->filesystem->write($filename, $file->content());
        $fileReference = new FileReference($filename);

        $this->repository->persist($fileReference);
    }
}
