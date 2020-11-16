<?php


namespace Scrum\Domain\Models\UserStories;


class UserStoryId
{
    /** @var string */
    private $value;

    /**
     * UserStoryId constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
