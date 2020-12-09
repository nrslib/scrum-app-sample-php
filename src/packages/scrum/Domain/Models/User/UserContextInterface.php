<?php


namespace Scrum\Domain\Models\User;


interface UserContextInterface
{
    function getId(): ?UserId;
}
