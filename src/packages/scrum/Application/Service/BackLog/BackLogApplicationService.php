<?php

namespace Scrum\Application\Service\BackLog;

use Basic\Exception\NotFoundException;
use Basic\Transaction\Transaction;
use Scrum\Domain\Models\User\UserContextInterface;
use Scrum\Domain\Models\UserStories\UserStory;
use Scrum\Domain\Models\UserStories\UserStoryId;
use Scrum\Domain\Models\UserStories\UserStoryRepositoryInterface;

class BackLogApplicationService
{
    /** @var Transaction */
    private $transaction;
    /** @var UserContextInterface */
    private $userContext;
    /** @var UserStoryRepositoryInterface */
    private $userStoryRepository;

    /**
     * BackLogApplicationService constructor.
     * @param UserStoryRepositoryInterface $userStoryRepository
     * @param Transaction $transaction
     * @param UserContextInterface $userContext
     */
    public function __construct(Transaction $transaction, UserContextInterface $userContext, UserStoryRepositoryInterface $userStoryRepository)
    {
        $this->transaction = $transaction;
        $this->userContext = $userContext;
        $this->userStoryRepository = $userStoryRepository;
    }

    public function getUserStory(string $aId): ?UserStory
    {
        $id = new UserStoryId($aId);
        return $this->userStoryRepository->find($id);
    }

    public function addUserStory(AddUserStoryCommand $command): void
    {
        $this->transaction->scope(function () use ($command) {
            $id = new UserStoryId(uniqid());

            $story = new UserStory(
                $id,
                $command->getStory(),
                $this->userContext->getId(),
                $command->getDemo()
            );
            $this->userStoryRepository->save($story);
        });
    }

    public function estimateUserStory(string $aId, int $estimation): void
    {
        $this->transaction->scope(function () use ($aId, $estimation) {
            $id = new UserStoryId($aId);
            $story = $this->userStoryRepository->find($id);
            if (is_null($story)) {
                throw new NotFoundException($aId . " not found.");
            }

            $story->estimate($estimation);
            $this->userStoryRepository->save($story);
        });
    }
}
