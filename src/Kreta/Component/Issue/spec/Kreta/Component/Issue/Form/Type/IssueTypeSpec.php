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

namespace spec\Kreta\Component\Issue\Form\Type;

use Kreta\Component\Issue\Factory\IssueFactory;
use Kreta\Component\Issue\Form\Type\IssueType;
use Kreta\Component\Project\Form\Type\LabelType;
use Kreta\Component\Project\Model\Interfaces\ProjectInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class IssueTypeSpec.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
class IssueTypeSpec extends ObjectBehavior
{
    function let(
        TokenStorageInterface $context,
        TokenInterface $token,
        UserInterface $user,
        IssueFactory $factory,
        LabelType $labelType
    )
    {
        $context->getToken()->shouldBeCalled()->willReturn($token);
        $token->getUser()->shouldBeCalled()->willReturn($user);
        $this->beConstructedWith('Kreta\Component\Issue\Model\Issue', $factory, $context, null, null, $labelType);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kreta\Component\Issue\Form\Type\IssueType');
    }

    function it_extends_kreta_abstract_type()
    {
        $this->shouldHaveType('Kreta\Component\Core\Form\Type\Abstracts\AbstractType');
    }

    function it_builds_a_form(FormBuilder $builder, ProjectInterface $project)
    {
        $builder->add('title', 'Symfony\Component\Form\Extension\Core\Type\TextType')
            ->shouldBeCalled()->willReturn($builder);
        $builder->add('description', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', ['required' => false,])
            ->shouldBeCalled()->willReturn($builder);
        $builder->add('project', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', [
            'class'           => 'Kreta\Component\Project\Model\Project',
            'choices'         => [$project],
            'invalid_message' => IssueType::PROJECT_INVALID_MESSAGE
        ])->shouldBeCalled()->willReturn($builder);

        $builder->get('project')->shouldBeCalled()->willReturn($builder);
        $builder->addEventListener(FormEvents::POST_SUBMIT, Argument::type('closure'))
            ->shouldBeCalled()->willReturn($builder);

        $this->buildForm($builder, ['projects' => [$project]]);
    }

    function it_sets_default_options(OptionsResolver $resolver)
    {
        $resolver->setDefaults(Argument::withEntry('data_class', 'Kreta\Component\Issue\Model\Issue'))
            ->shouldBeCalled()->willReturn($resolver);
        $resolver->setDefaults(Argument::withEntry('csrf_protection', false))
            ->shouldBeCalled()->willReturn($resolver);
        $resolver->setDefaults(Argument::withEntry('empty_data', Argument::type('closure')))
            ->shouldBeCalled()->willReturn($resolver);
        $resolver->setDefaults(['projects' => []])->shouldBeCalled()->willReturn($resolver);

        $this->configureOptions($resolver);
    }
}
