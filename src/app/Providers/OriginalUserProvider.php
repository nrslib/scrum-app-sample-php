<?php


namespace App\Providers;


use App\Models\Authorization\UserAdapter;
use Authorization\Application\Service\Authenticate\AuthenticateService;
use Authorization\Application\Service\User\UserService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

class OriginalUserProvider implements UserProvider
{
    /** @var AuthenticateService */
    private $authenticateService;
    /** @var UserService */
    private $userService;

    /**
     * OriginalUserProvider constructor.
     * @param AuthenticateService $authenticateService
     * @param UserService $userService
     */
    public function __construct(AuthenticateService $authenticateService, UserService $userService)
    {
        $this->authenticateService = $authenticateService;
        $this->userService = $userService;
    }

    public function retrieveById($identifier)
    {
        $user = $this->userService->retrieveById($identifier);

        if (is_null($user)) {
            return null;
        }

        return new UserAdapter($user);
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        $email = $credentials["email"];
        $user = $this->userService->retrieveByEmail($email);

        if (is_null($user)) {
            return null;
        }

        return new UserAdapter($user);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $password = $credentials["password"];
        $email = $credentials["email"];
        $result = $this->authenticateService->authenticate($email, $password);

        return $result;
    }
}
