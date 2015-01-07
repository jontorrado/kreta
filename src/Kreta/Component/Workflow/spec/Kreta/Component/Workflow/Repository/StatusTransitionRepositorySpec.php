<?php

/**
 * This file belongs to Kreta.
 * The source code of application includes a LICENSE file
 * with all information about license.
 *
 * @author benatespina <benatespina@gmail.com>
 * @author gorkalaucirica <gorka.lauzirika@gmail.com>
 */

namespace spec\Kreta\Component\Workflow\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class StatusTransitionRepositorySpec.
 *
 * @package spec\Kreta\Component\Workflow\Repository
 */
class StatusTransitionRepositorySpec extends ObjectBehavior
{
    function let(EntityManager $manager, ClassMetadata $metadata)
    {
        $this->beConstructedWith($manager, $metadata);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Component\Workflow\Repository\StatusTransitionRepository');
    }

    function it_extends_abstract_repository()
    {
        $this->shouldHaveType('Kreta\Component\Core\Repository\Abstracts\AbstractRepository');
    }
}
