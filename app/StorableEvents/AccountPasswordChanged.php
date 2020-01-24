<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class AccountPasswordChanged implements ShouldBeStored
{
    public int $accountId;
    public string $encryptedPassword;

    /**
     * AccountPasswordChanged constructor.
     * @param int $accountId
     * @param string $encryptedPassword
     */
    public function __construct(int $accountId, string $encryptedPassword)
    {
        $this->accountId = $accountId;
        $this->encryptedPassword = $encryptedPassword;
    }

    public function decryptPassword(): string
    {
        return decrypt($this->encryptedPassword);
    }
}
