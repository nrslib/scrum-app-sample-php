<?php


namespace Authorization\Application\Service\User;


use Authorization\Application\Service\User\UserCreate\UserCreateError;
use Authorization\Application\Service\User\UserCreate\UserCreateResult;
use Authorization\Domain\Users\Email;
use Authorization\Domain\Users\User;
use Authorization\Domain\Users\UserFactoryInterface;
use Authorization\Domain\Users\UserId;
use Authorization\Domain\Users\UserRepositoryInterface;
use Basic\Transaction\Transaction;

/**
 * Class UserService
 * @package Authorization\Application\Service\User
 */
class UserApplicationService
{
    /** @var Transaction */
    private $transaction;
    /** @var UserFactoryInterface */
    private $userFactory;
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserService constructor.
     * @param Transaction $transaction
     * @param UserFactoryInterface $userFactory
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(Transaction $transaction, UserFactoryInterface $userFactory, UserRepositoryInterface $userRepository)
    {
        $this->transaction = $transaction;
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     */
    public function create(string $email, string $password): UserCreateResult
    {
        return $this->transaction->scope(function () use ($email, $password) {
            $user = $this->userFactory->create($email, $password);

            $found = $this->userRepository->findByEmail($user->getEmail());
            if (!is_null($found)) {
                return UserCreateResult::fail(UserCreateError::EMAIL_ALREADY_USING);
            }

            $this->userRepository->save($user);

            return UserCreateResult::success($user->getId());
        });
    }

    public function retrieveById(string $aId): ?User
    {
        $id = new UserId($aId);
        $user = $this->userRepository->find($id);

        return $user;
    }

    /**
     * @param string $aEmail
     * @return User
     */
    public function retrieveByEmail(string $aEmail): ?User
    {
        $email = new Email($aEmail);
        $user = $this->userRepository->findByEmail($email);

        return $user;
    }
}
