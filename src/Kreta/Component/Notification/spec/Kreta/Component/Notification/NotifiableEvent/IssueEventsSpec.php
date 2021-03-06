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

namespace spec\Kreta\Component\Notification\NotifiableEvent;

use Kreta\Component\Issue\Model\Interfaces\IssueInterface;
use Kreta\Component\Notification\Factory\NotificationFactory;
use Kreta\Component\Notification\Model\Interfaces\NotificationInterface;
use Kreta\Component\Project\Model\Interfaces\ProjectInterface;
use Kreta\Component\User\Model\Interfaces\UserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class IssueEventsSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class IssueEventsSpec extends ObjectBehavior
{
    function let(NotificationFactory $factory, RouterInterface $router)
    {
        $this->beConstructedWith($factory, $router);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Component\Notification\NotifiableEvent\IssueEvents');
    }

    function it_implements_notifiable_event_interface()
    {
        $this->shouldImplement('Kreta\Component\Notification\NotifiableEvent\Interfaces\NotifiableEventInterface');
    }

    function it_supports_new_issue_events(IssueInterface $issue)
    {
        $this->supportsEvent('postPersist', $issue)->shouldReturn(true);
    }

    function it_gets_notifications(
        IssueInterface $issue,
        UserInterface $assignee,
        UserInterface $reporter,
        ProjectInterface $project,
        RouterInterface $router,
        NotificationFactory $factory,
        NotificationInterface $notification
    )
    {
        $issue->getAssignee()->shouldBeCalled()->willReturn($assignee);
        $issue->getReporter()->shouldBeCalled()->willReturn($reporter);
        $issue->getProject()->shouldBeCalled()->willReturn($project);
        $issue->getId()->shouldBeCalled()->willReturn('issue-id');

        $router->generate('get_issue', ['issueId' => 'issue-id'])->shouldBeCalled()->willReturn('http://kreta.io');

        $factory->create()->shouldBeCalled()->willReturn($notification);
        $issue->getProject()->shouldBeCalled()->willReturn($project);
        $notification->setProject($project)->shouldBeCalled()->willReturn($notification);
        $issue->getTitle()->shouldBeCalled()->willReturn('Issue title');
        $notification->setTitle('Issue title')->shouldBeCalled()->willReturn($notification);
        $issue->getDescription()->shouldBeCalled()->willReturn('The issue description');
        $notification->setDescription('The issue description')->shouldBeCalled()->willReturn($notification);
        $notification->setType('issue_new')->shouldBeCalled()->willReturn($notification);
        $notification->setResourceUrl('http://kreta.io')->shouldBeCalled()->willReturn($notification);
        $notification->setWebUrl('http://kreta.io')->shouldBeCalled()->willReturn($notification);
        $issue->getAssignee()->shouldBeCalled()->willReturn($assignee);
        $notification->setUser($assignee)->shouldBeCalled()->willReturn($notification);

        $this->getNotifications('postPersist', $issue)->shouldReturn([$notification]);
    }
}
