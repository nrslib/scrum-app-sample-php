<?php


namespace Scrum\Application\Service\BackLog;


class AddUserStoryCommand
{
    /** @var string */
    private $story;
    /** @var string|null */
    private $demo;

    /**
     * AddUserStoryCommand constructor.
     * @param string $story
     * @param string|null $demo
     */
    public function __construct(string $story, string $demo = null)
    {
        $this->story = $story;
        $this->demo = $demo;
    }

    /**
     * @return string
     */
    public function getStory(): string
    {
        return $this->story;
    }

    /**
     * @return string|null
     */
    public function getDemo(): ?string
    {
        return $this->demo;
    }
}
