<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class UserPasswordChanged implements ShouldBeStored
{
    public int $userId;
    public string $encryptedPassword;

    /**
     * UserPasswordChanged constructor.
     * @param int $userId
     * @param string $encryptedPassword
     */
    public function __construct(int $userId, string $encryptedPassword)
    {
        $this->userId = $userId;
        $this->encryptedPassword = $encryptedPassword;
    }

    public function decryptPassword(): string
    {
        return decrypt($this->encryptedPassword);
    }
}
