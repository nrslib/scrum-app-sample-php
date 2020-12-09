<?php


namespace App\Lib\Context;

use Illuminate\Support\Facades\Auth;
use Scrum\Domain\Models\User\UserContextInterface;
use Scrum\Domain\Models\User\UserId;

class AuthUserContext implements UserContextInterface
{
    function getId(): ?UserId
    {
        $user = Auth::user();

        if (is_null($user)) {
            return null;
        }

        $rawId = $user->getAuthIdentifier();

        $id = new UserId($rawId);

        return $id;
    }
}
