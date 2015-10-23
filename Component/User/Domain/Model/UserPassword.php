<?php

namespace Kreta\Component\User\Domain\Model;


class UserPassword
{
    private $encodedPassword;
    
    private $salt;
    
    public function __construct($aPlainPassword, UserPasswordEncoder $anEncoder, $salt = null)
    {
        $this->salt = $salt ?: base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->encodedPassword = $anEncoder->encode($aPlainPassword, $this->salt);
    }

    /**
     * Method that checks if the id given is equal to the current.
     *
     * @param UserPassword $aUserPassword A user password
     *
     * @return bool
     */
    public function equals(UserPassword $aUserPassword)
    {
        return $this->encodedPassword === $aUserPassword->encodedPassword;
    }

    public function encodedPassword()
    {
        return $this->encodedPassword;
    }
    
    public function salt()
    {
        return $this->salt;
    }
    
    /**
     * Magic method that represents the user password in string format.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->encodedPassword;
    }
}
