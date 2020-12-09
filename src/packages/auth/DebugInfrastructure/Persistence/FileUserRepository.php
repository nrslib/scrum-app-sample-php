<?php


namespace Authorization\DebugInfrastructure\Persistence;


use Authorization\Domain\Users\Email;
use Authorization\Domain\Users\User;
use Authorization\Domain\Users\UserId;
use Authorization\Domain\Users\UserRepositoryInterface;
use Basic\DebugSupport\Infrastructure\FileRepository;

class FileUserRepository implements UserRepositoryInterface
{
    use FileRepository;

    public function save(User $user): void
    {
        $id = $user->getId()->getValue();
        $this->store($id, $user);
    }

    function find(UserId $id): ?User
    {
        $user = $this->load($id->getValue());
        if (isset($user)) {
            return $user;
        } else {
            return null;
        }
    }

    function findByEmail(Email $email): ?User
    {
        $all = $this->loadAll();
        $targets = array_filter($all, function (User $x) use ($email) {
            return $x->getEmail()->equals($email);
        });

        if (count($targets) <= 0){
            return null;
        }

        $key = array_key_first($targets);
        return $targets[$key];
    }
}
