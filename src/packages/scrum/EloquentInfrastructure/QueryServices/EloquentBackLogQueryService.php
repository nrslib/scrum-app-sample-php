<?php


namespace Scrum\EloquentInfrastructure\QueryServices;


use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;
use Scrum\Application\Service\BackLog\Query\UserStorySummary;
use Scrum\Domain\Models\UserStories\UserStory;
use Scrum\Domain\Models\UserStories\UserStoryId;
use Scrum\EloquentInfrastructure\Models\UserStoryDataModel;

class EloquentBackLogQueryService implements BackLogQueryServiceInterface
{

    function getAllUserStory(): array
    {
        $all = UserStoryDataModel::all();
        $stories = [];
        foreach ($all as $elem) {
            $id = $elem->id;
            $story = $elem->story;
            $demo = $elem->demo;
            $estimate = $elem->estimate;
            $seq = $elem->seq;

            $data = new UserStorySummary(
                $id,
                $story,
                $demo,
                $estimate,
                $seq
            );

            array_push($stories, $data);
        }

        return $stories;
    }
}
