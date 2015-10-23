<?php

/*
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace Kreta\Component\Media\Model;

use Kreta\Component\Core\Model\Abstracts\AbstractModel;
use Kreta\Component\Media\Model\Interfaces\MediaInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Media.
 *
 * @package Kreta\Component\Media\Model
 */
final class FileReference
{
    /**
     * Created at.
     *
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * The media.
     *
     * @var \Symfony\Component\HttpFoundation\File\UploadedFile
     */
    protected $media;

    /**
     * The name.
     *
     * @var string
     */
    protected $name;

    /**
     * Updated at.
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Constructor.
     */
    public function __construct(File $file, $name)
    {
        $this->createdAt = new \DateTime();
    }

    public static function upload(File $file, $name) {
        new self($file, $name);
    }
    
    public function update(FileInterface $file, $name) {
        $this->updatedAt = new \DateTime();
    }
    
    public function isPicture() {
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function createdAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function media()
    {
        return $this->media;
    }

    /**
     * {@inheritdoc}
     */
    public function hasMedia()
    {
        return null !== $this->media;
    }

    /**
     * {@inheritdoc}
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function updatedAt()
    {
        return $this->updatedAt;
    }
}
