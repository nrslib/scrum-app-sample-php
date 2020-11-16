<?php


namespace App\Http\ViewModels\BackLog;


class BackLogIndexViewModel
{
    /** @var UserStoryViewModel[] */
    public $userStories;

    /**
     * BackLogIndexViewModel constructor.
     * @param UserStoryViewModel[] $userStories
     */
    public function __construct(array $userStories)
    {
        $this->userStories = $userStories;
    }
}
