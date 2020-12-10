<?php


namespace Scrum\Domain\Models\UserStories;


use Scrum\Domain\Models\User\UserId;

/**
 * Class UserStory
 * @package nrslib\ScrumDomain\Models\UserStories
 */
class UserStory
{
    /** @var UserStoryId */
    private $id;
    /** @var string */
    private $story;
    /** @var UserId */
    private $author;
    /** @var string|null */
    private $demo;
    /** @var int|null */
    private $estimation;
    /** @var int|null */
    private $seq;

    /**
     * UserStory constructor.
     * @param UserStoryId $id
     * @param string $story
     * @param UserId $author
     * @param string|null $demo
     * @param int|null $estimation
     * @param int|null $seq
     */
    public function __construct(UserStoryId $id, string $story, UserId $author, string $demo = null, int $estimation = null, int $seq = null)
    {
        if (strlen($story) == 0) {
            throw new \InvalidArgumentException("story is empty.");
        }

        $this->id = $id;
        $this->story = $story;
        $this->author = $author;
        $this->demo = $demo;
        $this->estimation = $estimation;
        $this->seq = $seq;
    }

    /**
     * @return UserStoryId
     */
    public function getId(): UserStoryId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStory(): string
    {
        return $this->story;
    }

    /**
     * @return UserId
     */
    public function getAuthor(): UserId
    {
        return $this->author;
    }

    /**
     * @return string|null
     */
    public function getDemo(): ?string
    {
        return $this->demo;
    }

    /**
     * @return int|null
     */
    public function getEstimation(): ?int
    {
        return $this->estimation;
    }

    /**
     * @return int|null
     */
    public function getSeq(): ?int
    {
        return $this->seq;
    }

    public function estimate(int $estimation)
    {
        $this->estimation = $estimation;
    }
}
