<?php

namespace Kreta\Component\User\Application\Service;

use Kreta\Component\User\Domain\Model\User;
use Kreta\Component\User\Domain\Model\UserAlreadyExistException;
use Kreta\Component\User\Domain\Model\UserEmail;
use Kreta\Component\User\Domain\Model\UserId;
use Kreta\Component\User\Domain\Model\UserPasswordEncoder;
use Kreta\Component\User\Domain\Model\UserRepository;

/**
 * Sign up user service class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class SignUpUserService implements ApplicationService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * Constructor.
     *
     * @param UserRepository      $aRepository The user repository
     * @param UserPasswordEncoder $anEncoder   The password encoder
     */
    public function __construct(UserRepository $aRepository, UserPasswordEncoder $anEncoder)
    {
        $this->repository = $aRepository;
        $this->encoder = $anEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($request = null)
    {
        $email = $request->email();
        $password = $request->password();

        if(null !== $this->repository->userOfEmail($email)) {
            throw new UserAlreadyExistException();
        }

        $user = User::register(
            new UserId(),
            new UserEmail($email),
            $password,
            $this->encoder
        );

        $this->repository->persist($user);
    }
}
