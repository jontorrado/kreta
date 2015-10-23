<?php

namespace Kreta\Component\User\Domain\Model;

use Ddd\Domain\DomainEventPublisher;

final class User
{
    /**
     * @var \Kreta\Component\User\Domain\Model\UserId
     */
    private $id;

    /**
     * @var \Kreta\Component\User\Domain\Model\UserEmail
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    private $createdOn;

    private $updatedOn;
    
    private $lastLogin;
    
    private $confirmationToken;

    private function __construct(UserId $anId, UserEmail $anEmail, $aPassword, UserPasswordEncoder $encoder)
    {
        $this->id = $anId;
        $this->email = $anEmail;
        $this->password = new UserPassword($aPassword, $encoder);
        $this->createdOn = new \DateTime();
        $this->updatedOn = new \DateTime();
        $this->lastLogin = null;
        $this->confirmationToken = new UserConfirmationToken();

        DomainEventPublisher::instance()->publish(new UserRegistered($this));
    }

    public static function register(UserId $anId, UserEmail $anEmail, $aPassword, UserPasswordEncoder $encoder)
    {
        return new self($anId, $anEmail, $aPassword, $encoder);
    }
    
    public function activateAccount() 
    {
        $this->confirmationToken = null;    
    }

    public function rememberPassword()
    {
        $this->confirmationToken = new UserConfirmationToken();
        
        DomainEventPublisher::instance()->publish(new UserRememberPasswordRequested($this));
    }
    
    public function isActive()
    {
        return $this->confirmationToken === null;
    }
    
    public function login() 
    {
        $this->lastLogin = new \DateTime();
        
        DomainEventPublisher::instance()->publish(new UserLoggedIn($this));
    }
    
    public function id()
    {
        return $this->id;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }
    
    public function confirmationToken()
    {
        return $this->confirmationToken;
    }
}

