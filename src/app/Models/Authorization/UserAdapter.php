<?php


namespace App\Models\Authorization;


use Authorization\Domain\Users\User;
use Illuminate\Contracts\Auth\Authenticatable;

class UserAdapter implements Authenticatable
{
    /** @var User */
    private $core;

    /**
     * UserProxy constructor.
     * @param User $core
     */
    public function __construct(User $core)
    {
        $this->core = $core;
    }

    public function getAuthIdentifierName()
    {
        return "id";
    }

    public function getAuthIdentifier()
    {
        return $this->core->getId()->getValue();
    }

    public function getAuthPassword()
    {
        return $this->core->getPasswordHash()->getValue();
    }

    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
