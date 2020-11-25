<?php


namespace Authorization\Domain\Users;


use Basic\DomainSupport\ValueObjects\StringValueObject;

class UserId extends StringValueObject
{
    /**
     * UserId constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
