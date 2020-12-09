<?php


namespace Scrum\DebugInfrastructure\QueryServices;


use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;
use Scrum\Application\Service\BackLog\Query\UserStorySummary;
use Scrum\DebugInfrastructure\Persistence\UserStories\FileUserStoryRepository;
use Scrum\Domain\Models\UserStories\UserStory;

class FileBackLogQueryService implements BackLogQueryServiceInterface
{
    /** @var FileUserStoryRepository */
    private $repository;

    /**
     * FileBackLogQueryService constructor.
     * @param FileUserStoryRepository $repository
     */
    public function __construct(FileUserStoryRepository $repository)
    {
        $this->repository = $repository;
    }

    function getAllUserStory(): array
    {
        $all = $this->repository->loadAll();

        $summaries = array_map(function (UserStory $story) {
            return new UserStorySummary(
                $story->getId()->getValue(),
                $story->getStory(),
                $story->getAuthor()->getValue(),
                $story->getDemo(),
                $story->getEstimate(),
                $story->getSeq()
            );
        }, $all);
        return $summaries;
    }
}
