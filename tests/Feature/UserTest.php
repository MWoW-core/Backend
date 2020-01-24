<?php

namespace Tests\Feature;

use App\Account;
use App\AccountBan;
use App\Enums\AccountExpansion;
use App\Enums\UserRole;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testTheAuthenticatedUserResourceIncludesTheirAccountsAndAccountBans()
    {
        $username = $this->faker()->userName;
        $email = $this->faker()->safeEmail;

        $this->be(
            factory(User::class)->create([
                'role' => UserRole::Player,
                'account_name' => $username,
                'email' => $email
            ])
        );

        $account = factory(Account::class)->create([
            'username' => $username,
            'last_ip' => '127.0.0.1',
            'last_attempt_ip' => '169.10.10.1',
            'last_login' => '2020-01-20 10:00:00',
            'vp' => 100,
            'dp' => 500,
            'email' => $email,
            'reg_mail' => $email,
            'joindate' => '2020-01-20',
            'locked' => false,
            'online' => false,
            'expansion' => AccountExpansion::WoTLK
        ]);
        factory(AccountBan::class)->create([
            'id' => $account->id,
            'banreason' => 'testing bans'
        ]);

        $this
            ->json('GET', '/api/user')
            ->assertSuccessful()
            ->assertJsonFragment([
                'role' => UserRole::Player()->description,
                'account_name' => $username,
                'email' => $email
            ])
            ->assertJsonFragment([
                'status' => 'Banned',
                'username' => $username,
                'last_ip' => '127.0.0.1',
                'last_attempt_ip' => '169.10.10.1',
                'last_login' => '2020-01-20 10:00:00',
                'failed_logins' => 0,
                'locked' => false,
                'online' => false,
                'expansion' => AccountExpansion::WoTLK()->description,
                'vp' => 100,
                'dp' => 500,
                'email' => $email,
                'reg_mail' => $email,
                'joindate' => '2020-01-20'
            ]);
    }
}
