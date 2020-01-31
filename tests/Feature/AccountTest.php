<?php

namespace Tests\Feature;

use App\Account;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;
use function factory;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function testCanBanTheAccount()
    {
        $this->be(
          factory(User::class)->create(['account_name' => 'JudgeJudy'])
        );

        /** @var Account $account */
        $account = factory(Account::class)->create();

        $account->ban('Klutz.', '2020-01-01');

        $this->assertDatabaseHas('account_banned', [
            'id' => $account->id,
            'bannedby' => 'JudgeJudy',
            'banreason' => 'Klutz.',
            'bandate' => Date::parse('2020-01-01')->unix(),
            'active' => true
        ], 'auth');
    }

    public function testCanUnbanAPlayer()
    {
        /** @var Account $account */
        $account = factory(Account::class)->create();

        $account->ban('Klutz.', '2020-01-01');

        $account->unban();

        $this->assertDatabaseHas('account_banned', [
           'id' => $account->id,
            'active' => false
        ], 'auth');
    }

    public function testItDeterminesTheAccountStatus()
    {
        $online = factory(Account::class)->create(['online' => true]);

        self::assertEquals('Online', $online->status);

        /** @var Account $banned */
        $banned = factory(Account::class)->create();
        $banned->ban('testing');

        self::assertEquals('Banned', $banned->status);

        $banned->unban();

        self::assertEquals('Offline', $banned->status);
    }
}
