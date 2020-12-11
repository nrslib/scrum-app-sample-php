<?php


namespace Authorization\Application\Service\User\UserCreate;


use Authorization\Domain\Users\UserId;

class UserCreateResult
{
    public static function success(UserId $id)
    {
        return new UserCreateResult($id, null);
    }

    public static function fail(int $errorCode)
    {
        return new UserCreateResult(null, $errorCode);
    }

    /** @var UserId */
    private $createdUserId;
    /** @var int|null */
    private $errorCode;

    /**
     * UserCreateResult constructor.
     * @param UserId|null $createdUserId
     * @param int|null $errorCode
     */
    private function __construct(?UserId $createdUserId, int $errorCode)
    {
        $this->createdUserId = $createdUserId;
        $this->errorCode = $errorCode;
    }

    /**
     * @return UserId
     */
    public function getCreatedUserId(): UserId
    {
        return $this->createdUserId;
    }

    /**
     * @return int|null
     */
    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    public function isError(): bool
    {
        return !is_null($this->errorCode);
    }
}
