<?php


namespace Authorization\Domain\Users;


use Basic\DomainSupport\ValueObjects\StringValueObject;

class Email extends StringValueObject
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
