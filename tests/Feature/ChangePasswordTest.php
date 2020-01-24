<?php

namespace Tests\Feature;

use App\Account;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use function factory;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testItChangesThePasswordBothIngameAndWeb()
    {
        $username = $this->faker()->userName;

        $this->be(
            /** @var User $user */
            $user = factory(User::class)->create([
                'account_name' => $username,
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ])
        );

        $account = factory(Account::class)->create(['username' => $username]);

        $this
            ->postJson('/api/change-password', [
                'current_password' => 'password',
                'password' => 'my-new-password',
                'password_confirmation' => 'my-new-password'
            ])
            ->assertSuccessful();

        self::assertTrue(
            Hash::check('my-new-password', $user->refresh()->password),
            'User password was not changed.'
        );

        self::assertTrue(
            Hash::driver('sha1')->check('my-new-password', $account->refresh()->sha_pass_hash, ['name' => $username]),
            'Account password was not changed.'
        );
    }

    public function testValidationFailsIfCurrentPasswordIsIncorrect()
    {
        $this->actingAs(
            factory(User::class)->create()
        )->postJson('/api/change-password', [
            'current_password' => 'incorrect'
        ])->assertJsonValidationErrors('current_password');
    }
}
