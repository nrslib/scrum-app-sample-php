<?php


namespace Authorization\Domain\Users;


use Illuminate\Hashing\BcryptHasher;

class PasswordHasher
{
    /** @var BcryptHasher */
    private $hasher;

    /**
     * PasswordHasher constructor.
     */
    public function __construct()
    {
        $this->hasher = new BcryptHasher();
    }

    public function check(string $password, PasswordHash $hash): bool
    {
        return $this->hasher->check($password, $hash->getValue());
    }

    public function checkByUser(string $password, User $user): bool {
        return $this->check($password, $user->getPasswordHash());
    }

    public function make(string $password): PasswordHash
    {
        $rawPasswordHash = $this->hasher->make($password);
        return new PasswordHash($rawPasswordHash);
    }
}
