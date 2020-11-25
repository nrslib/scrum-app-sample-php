<?php


namespace Basic\DomainSupport\ValueObjects;


abstract class StringValueObject
{
    /** @var string */
    private $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }
}
