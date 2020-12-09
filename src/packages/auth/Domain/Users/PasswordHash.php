<?php


namespace Authorization\Domain\Users;


use Basic\DomainSupport\ValueObjects\StringValueObject;

/**
 * Class PasswordHash
 * @package Authorization\Domain\Users
 */
class PasswordHash extends StringValueObject
{
    /**
     * PasswordHash constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
