<?php

/**
 * (c) benatespina <benatespina@gmail.com>
 *
 * This file belongs to myClapboard.
 * The source code of application includes a LICENSE file
 * with all information about license.
 */

namespace Kreta\Component\User\Application\Service;

use Ddd\Application\Service\ApplicationService;
use Kreta\Component\User\Domain\Model\UserDoesNotExistException;
use Kreta\Component\User\Domain\Model\UserInactiveException;
use Kreta\Component\User\Domain\Model\UserInvalidPasswordException;
use Kreta\Component\User\Domain\Model\UserPassword;
use Kreta\Component\User\Domain\Model\UserPasswordEncoder;
use Kreta\Component\User\Domain\Model\UserRepository;

class LogInUserService implements ApplicationService
{
    /**
     * @var \Kreta\Component\User\Domain\Model\UserRepository
     */
    private $repository;

    private $encoder;

    public function __construct(UserRepository $aRepository, UserPasswordEncoder $anEncoder)
    {

        $this->repository = $aRepository;
        $this->encoder = $anEncoder;
    }

    public function execute($request = null)
    {
        $userId = $request->userId();
        $password = $request->password();
        $user = $this->repository->userOfId($userId);

        if (null === $user) {
            throw new UserDoesNotExistException();
        }

        if (false === $user->isActive) {
            throw new UserInactiveException();
        }

        if (false === $user->password()->equals(
                new UserPassword($password, $user->password()->salt(), $this->encoder)
            )
        ) {
            throw new UserInvalidPasswordException();
        }

        $user->login();
    }
}
