<?php

namespace Kreta\Component\User\Domain\Model;

/**
 * User repository domain class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 * @author Gorka Laucirica <gorka.lauzirika@gmail.com>
 */
interface UserRepository
{
    /**
     * Finds the user of given id.
     *
     * @param UserId $anId The user id
     *
     * @return User
     */
    public function userOfId(UserId $anId);

    /**
     * Finds the user of given email.
     *
     * @param UserEmail $anEmail The user email
     *
     * @return User
     */
    public function userOfEmail(UserEmail $anEmail);

    /**
     * Finds users with the given specification.
     *
     * @param object $specification The specification
     *
     * @return User[]
     */
    public function query($specification);

    /**
     * Persist the given user.
     *
     * @param User $aUser The user
     */
    public function persist(User $aUser);

    /**
     * Removes the given user.
     *
     * @param User $aUser The user
     */
    public function remove(User $aUser);

    /**
     * Counts the users.
     *
     * @return int
     */
    public function size();

    /**
     * Gets the next user id.
     *
     * @return UserId
     */
    public function nextIdentity();
}
