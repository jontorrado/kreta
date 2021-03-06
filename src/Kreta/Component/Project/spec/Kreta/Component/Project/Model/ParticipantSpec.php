<?php

/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Kreta\Component\Project\Model;

use Kreta\Component\Project\Model\Interfaces\ProjectInterface;
use Kreta\Component\User\Model\Interfaces\UserInterface;
use PhpSpec\ObjectBehavior;

/**
 * Class ParticipantSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class ParticipantSpec extends ObjectBehavior
{
    function let(ProjectInterface $project, UserInterface $user)
    {
        $this->beConstructedWith($project, $user);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Component\Project\Model\Participant');
    }

    function it_implements_project_role_interface()
    {
        $this->shouldImplement('Kreta\Component\Project\Model\Interfaces\ParticipantInterface');
    }

    function its_project_is_mutable(ProjectInterface $project)
    {
        $this->setProject($project)->shouldReturn($this);
        $this->getProject()->shouldReturn($project);
    }

    function its_role_is_mutable()
    {
        $this->setRole('ROLE_DUMMY')->shouldReturn($this);
        $this->getRole()->shouldReturn('ROLE_DUMMY');
    }

    function its_user_is_mutable(UserInterface $user)
    {
        $this->setUser($user)->shouldReturn($this);
        $this->getUser()->shouldReturn($user);
    }
}
