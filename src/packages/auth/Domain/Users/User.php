<?php


namespace Authorization\Domain\Users;


class User
{
    /** @var UserId */
    private $id;
    /** @var Email */
    private $email;
    /** @var PasswordHash */
    private $passwordHash;

    /**
     * User constructor.
     * @param UserId $id
     * @param Email $email
     * @param PasswordHash $passwordHash
     */
    public function __construct(UserId $id, Email $email, PasswordHash $passwordHash)
    {
        $this->id = $id;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return PasswordHash
     */
    public function getPasswordHash(): PasswordHash
    {
        return $this->passwordHash;
    }
}
