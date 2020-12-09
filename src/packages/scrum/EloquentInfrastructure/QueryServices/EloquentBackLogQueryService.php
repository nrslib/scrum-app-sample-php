<?php


namespace Scrum\EloquentInfrastructure\QueryServices;


use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;
use Scrum\Application\Service\BackLog\Query\UserStorySummary;
use Scrum\Domain\Models\User\UserContextInterface;
use Scrum\Domain\Models\UserStories\UserStory;
use Scrum\Domain\Models\UserStories\UserStoryId;
use Scrum\EloquentInfrastructure\Models\UserStoryDataModel;

class EloquentBackLogQueryService implements BackLogQueryServiceInterface
{
    /** @var UserContextInterface */
    private $userContext;

    /**
     * EloquentBackLogQueryService constructor.
     * @param UserContextInterface $userContext
     */
    public function __construct(UserContextInterface $userContext)
    {
        $this->userContext = $userContext;
    }

    function getAllUserStory(): array
    {
        $all = UserStoryDataModel::all();
        $stories= $all->map(function (UserStoryDataModel $elem) {
            $id = $elem->id;
            $story = $elem->story;
            $author = $elem->author;
            $demo = $elem->demo;
            $estimate = $elem->estimate;
            $seq = $elem->seq;

            return new UserStorySummary(
                $id,
                $story,
                $author,
                $demo,
                $estimate,
                $seq
            );
        })->all();

        return $stories;
    }
}
