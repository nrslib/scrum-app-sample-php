<?php


namespace Authorization\Domain\Users;


interface UserRepositoryInterface
{
    function find(UserId $id): ?User;

    function findByEmail(Email $email): ?User;

    function save(User $user): void;
}
