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
    public function __construct($name)
    {
        $this->name = $name;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function update($name)
    {
        $this->name = $name;
        $this->updatedAt = new \DateTime();
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
