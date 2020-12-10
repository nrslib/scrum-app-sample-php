<?php


namespace Scrum\EloquentInfrastructure\Persistence\UserStories;


use Scrum\Domain\Models\User\UserId;
use Scrum\Domain\Models\UserStories\UserStory;
use Scrum\Domain\Models\UserStories\UserStoryId;
use Scrum\Domain\Models\UserStories\UserStoryRepositoryInterface;
use Scrum\EloquentInfrastructure\Models\UserStoryDataModel;

class EloquentUserStoryRepository implements UserStoryRepositoryInterface
{
    public function find(UserStoryId $id): ?UserStory
    {
        $data = UserStoryDataModel::where("id", $id->getValue())
            ->first();

        if (is_null($data)) {
            return null;
        }

        return new UserStory(
            new UserStoryId($data->id),
            $data->story,
            new UserId($data->author),
            $data->demo,
            $data->estimate,
            $data->seq
        );
    }

    public function save(UserStory $userStory): void
    {
        UserStoryDataModel::updateOrCreate(
            ["id" => $userStory->getId()->getValue()],
            [
                "story" => $userStory->getStory(),
                "author" => $userStory->getAuthor()->getValue(),
                "demo" => $userStory->getDemo(),
                "estimate" => $userStory->getEstimate(),
                "seq" => $userStory->getSeq()
            ]
        );
    }
}
