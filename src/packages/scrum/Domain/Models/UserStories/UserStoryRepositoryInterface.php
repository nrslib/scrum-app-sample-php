<?php


namespace Scrum\Domain\Models\UserStories;


interface UserStoryRepositoryInterface
{
    public function find(UserStoryId $id): ?UserStory;
    public function save(UserStory $userStory): void;
}
