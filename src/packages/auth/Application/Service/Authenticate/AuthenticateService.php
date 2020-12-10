<?php


namespace Authorization\Application\Service\Authenticate;


use Authorization\Domain\Users\Email;
use Authorization\Domain\Users\PasswordHasher;
use Authorization\Domain\Users\UserRepositoryInterface;

class AuthenticateService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * AuthenticateService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate(string $aEmail, string $password): bool
    {
        $email = new Email($aEmail);
        $user = $this->userRepository->findByEmail($email);
        if (is_null($user)) {
            return false;
        }

        $hasher = new PasswordHasher();
        return $hasher->checkByUser($password, $user);
    }
}
