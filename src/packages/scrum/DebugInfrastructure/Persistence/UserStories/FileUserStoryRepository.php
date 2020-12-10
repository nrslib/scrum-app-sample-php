<?php


namespace Scrum\DebugInfrastructure\Persistence\UserStories;


use Basic\DebugSupport\Infrastructure\FileRepository;
use Scrum\Domain\Models\UserStories\UserStory;
use Scrum\Domain\Models\UserStories\UserStoryId;
use Scrum\Domain\Models\UserStories\UserStoryRepositoryInterface;

class FileUserStoryRepository implements UserStoryRepositoryInterface
{
    use FileRepository;

    public function find(UserStoryId $id): ?UserStory
    {
        $story = $this->load($id->getValue());
        if (is_null($story)) {
            return null;
        } else {
            return $story;
        }
    }

    public function save(UserStory $userStory): void
    {
        $rawId = $userStory->getId()->getValue();
        $this->store($rawId, $userStory);
    }
}
