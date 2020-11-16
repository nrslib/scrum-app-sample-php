<?php

namespace Scrum\Application\Service\BackLog;

use Illuminate\Support\Str;
use Scrum\Domain\Models\UserStories\UserStory;
use Scrum\Domain\Models\UserStories\UserStoryId;
use Scrum\Domain\Models\UserStories\UserStoryRepositoryInterface;

class BackLogApplicationService
{
    /** @var UserStoryRepositoryInterface */
    private $userStoryRepository;

    /**
     * BackLogApplicationService constructor.
     * @param UserStoryRepositoryInterface $userStoryRepository
     */
    public function __construct(UserStoryRepositoryInterface $userStoryRepository)
    {
        $this->userStoryRepository = $userStoryRepository;
    }

    public function addUserStory(AddUserStoryCommand $command){
        $id = new UserStoryId(Str::uuid());

        $story = new UserStory($id, $command->getStory(), $command->getDemo());
        $this->userStoryRepository->save($story);
    }

    public function getBackLog() {

    }
}
