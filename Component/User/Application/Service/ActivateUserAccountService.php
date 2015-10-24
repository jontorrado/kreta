<?php

namespace Kreta\Component\User\Application\Service;

use Kreta\Component\User\Domain\Model\UserConfirmationToken;
use Kreta\Component\User\Domain\Model\UserConfirmationTokenNotFoundException;
use Kreta\Component\User\Repository\UserRepository;

/**
 * Activate user account service class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class ActivateUserAccountService implements ApplicationService
{
    /**
     * The user repository.
     *
     * @var UserRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param UserRepository $aRepository The user repository
     */
    public function __construct(UserRepository $aRepository)
    {
        $this->repository = $aRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($request = null)
    {
        $confirmationToken = $request->confirmationToken();

        $user = $this->repository->userOfConfirmationToken(new UserConfirmationToken($confirmationToken));
        if (null === $user) {
            throw new UserConfirmationTokenNotFoundException();
        }
        $user->enableAccount();

        $this->repository->persist($user);
    }
}
