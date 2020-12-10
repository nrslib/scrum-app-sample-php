<?php


namespace Scrum\EloquentInfrastructure\QueryServices;


use Scrum\Application\Service\BackLog\Query\BackLogQueryServiceInterface;
use Scrum\Application\Service\BackLog\Query\UserStorySummary;
use Scrum\Domain\Models\User\UserContextInterface;
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
        $stories = UserStoryDataModel::all()
            ->map(function (UserStoryDataModel $x) {
                return new UserStorySummary(
                    $x->id,
                    $x->story,
                    $x->author,
                    $x->demo,
                    $x->estimation,
                    $x->seq
                );
            })
            ->sort(function (UserStorySummary $l, UserStorySummary $r) {
                $lIsNull = is_null($l->seq);
                $rIsNull = is_null($r->seq);

                if ($lIsNull && $rIsNull) {
                    return 0;
                }
                if ($lIsNull) {
                    return -1;
                }
                if ($rIsNull) {
                    return 1;
                }

                return $l->seq - $r->seq;
            })
            ->all();

        return $stories;
    }
}
