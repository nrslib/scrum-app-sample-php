<?php


namespace Scrum\EloquentInfrastructure\Persistence\UserStories;


use Scrum\Domain\Models\UserStories\UserStory;
use Scrum\Domain\Models\UserStories\UserStoryId;
use Scrum\Domain\Models\UserStories\UserStoryRepositoryInterface;
use Scrum\EloquentInfrastructure\Models\UserStoryDataModel;

class EloquentUserStoryRepository implements UserStoryRepositoryInterface
{

    public function find(UserStoryId $id): UserStory
    {
        // TODO: Implement find() method.
    }

    public function save(UserStory $userStory): void
    {
        UserStoryDataModel::updateOrCreate(
            [ "id" => $userStory->getId()->getValue() ],
            [
                "story" => $userStory->getStory(),
                "demo" => $userStory->getDemo(),
                "estimate" => $userStory->getEstimate(),
                "seq" => $userStory->getSeq()
            ]
        );
    }
}
