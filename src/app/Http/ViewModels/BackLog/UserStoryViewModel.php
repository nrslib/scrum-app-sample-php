<?php


namespace App\Http\ViewModels\BackLog;


class UserStoryViewModel
{
    /** @var string */
    public $id;
    /** @var string */
    public $story;
    /** @var string */
    public $demo;
    /** @var int|null */
    public $estimate;
    /** @var string */
    public $authorId;

    /**
     * UserStoryViewModel constructor.
     * @param string $id
     * @param string $story
     * @param string $authorId
     * @param string|null $demo
     * @param int|null $estimate
     */
    public function __construct(string $id, string $story, string $authorId, ?string $demo, ?int $estimate)
    {
        $this->id = $id;
        $this->story = $story;
        $this->authorId = $authorId;
        $this->demo = $demo;
        $this->estimate = $estimate;
    }
}
