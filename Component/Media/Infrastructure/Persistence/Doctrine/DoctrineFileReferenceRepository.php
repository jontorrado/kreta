<?php

namespace Infrastructure\Persistence\Doctrine;

use Doctrine\ORM\EntityManager;
use Domain\Model\FileReferenceRepository;
use Kreta\Component\Media\Model\FileReference;

class DoctrineFileReferenceRepository implements FileReferenceRepository
{
    /**
     * The entity manager.
     *
     * @var \Doctrine\ORM\EntityManager
     */
    private $anEntityManager;

    /**
     * Contructor.
     *
     * @param \Doctrine\ORM\EntityManager $anEntityManager The entity manager
     */
    public function __construct(EntityManager $anEntityManager)
    {
        $this->anEntityManager = $anEntityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function persist(FileReference $aFileReference)
    {
        $this->anEntityManager->persist($aFileReference);
    }
}
