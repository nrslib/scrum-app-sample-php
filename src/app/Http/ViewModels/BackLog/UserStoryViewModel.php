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
    /** @var int|null */
    public $seq;

    /**
     * UserStoryViewModel constructor.
     * @param string $id
     * @param string $story
     * @param string|null $demo
     * @param int|null $estimate
     * @param int|null $seq
     */
    public function __construct(string $id, string $story, ?string $demo, ?int $estimate, ?int $seq)
    {
        $this->id = $id;
        $this->story = $story;
        $this->demo = $demo;
        $this->estimate = $estimate;
        $this->seq = $seq;
    }
}
