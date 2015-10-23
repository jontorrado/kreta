<?php

namespace Kreta\Component\User\Infrastructure\UserPasswordEncoder;

use Kreta\Component\User\Domain\Model\UserPasswordEncoder;

final class BcryptUserPasswordEncoder implements UserPasswordEncoder
{
    /**
     * {@inheritdoc}
     */
    public function encode($aPlainPassword, $aSalt)
    {
        // TODO: Implement encode() method.
    }
}
