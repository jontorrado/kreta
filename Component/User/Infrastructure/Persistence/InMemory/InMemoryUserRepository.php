<?php

namespace Kreta\Component\User\Infrastructure\Persistence\Doctrine;

use Kreta\Component\User\Domain\Model\User;
use Kreta\Component\User\Domain\Model\UserEmail;
use Kreta\Component\User\Domain\Model\UserId;
use Kreta\Component\User\Domain\Model\UserRepository;

/**
 * In memory user repository class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
final class InMemoryUserRepository implements UserRepository
{
    /**
     * Array which contains the users.
     *
     * @var array
     */
    private $users;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->users = [];
    }

    /**
     * {@inheritdoc}
     */
    public function userOfId(UserId $anId)
    {
        if (isset($this->users[$anId->id()])) {
            return $this->users[$anId->id()];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function userOfEmail(UserEmail $anEmail)
    {
        if (isset($this->users[$anEmail->email()])) {
            return $this->users[$anEmail->email()];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function query($specification)
    {
        return array_values(
            array_filter(
                $this->users,
                function (User $aUser) use ($specification) {
                    return $specification->specifies($aUser);
                }
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function persist(User $aUser)
    {
        $this->users[$aUser->id()->id()] = $aUser;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(User $aUser)
    {
        unset($this->users[$aUser->id()->id()]);
    }

    /**
     * {@inheritdoc}
     */
    public function size()
    {
        return count($this->users);
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity()
    {
        return new UserId();
    }
}
