<?php


namespace Scrum\Application\Service\BackLog\Query;


interface BackLogQueryServiceInterface
{
    /**
     * @return UserStorySummary[]
     */
    function getAllUserStory(): array;
}
