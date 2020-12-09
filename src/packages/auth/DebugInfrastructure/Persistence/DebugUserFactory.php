<?php


namespace Authorization\DebugInfrastructure\Persistence;


use Authorization\Domain\Users\Email;
use Authorization\Domain\Users\PasswordHasher;
use Authorization\Domain\Users\User;
use Authorization\Domain\Users\UserFactoryInterface;
use Authorization\Domain\Users\UserId;
use Authorization\Domain\Users\UserRepositoryInterface;

class DebugUserFactory implements UserFactoryInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * DebugUserFactory constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(string $email, string $password): User
    {
        $hasher = new PasswordHasher();
        $oasswordHash = $hasher->make($password);
        while (true) {
            $uuid = uniqid();
            $id = new UserId($uuid);
            $target = $this->userRepository->find($id);
            if (is_null($target)) {
                return new User(
                    $id,
                    new Email($email),
                    $oasswordHash
                );
            }
        }
    }
}
