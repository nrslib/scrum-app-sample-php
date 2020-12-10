<?php


namespace Basic\DomainSupport\ValueObjects;


abstract class StringValueObject
{
    /** @var string */
    private $value;

    protected function __construct(string $value)
    {
        if (!isset($value) || trim($value) === "") {
            throw new \InvalidArgumentException("need any value");
        }
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function equals(StringValueObject $arg)
    {
        $thisValue = $this->value;
        $thisGetValue = $this->getValue();
        $argValue = $arg->value;
        $argGetValue = $arg->getValue();
        return $this->value === $arg->value;
    }
}
