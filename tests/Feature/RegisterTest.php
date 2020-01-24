<?php

namespace Tests\Feature;

use App\Account;
use App\AccountPassword;
use App\Hashing\Sha1Hasher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testRegisteringAlsoCreatesAGameAccount()
    {
        $this->postJson('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'account_name' => $username = $this->faker->firstName,
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'account_name' => $username,
        ]);

        $this->assertDatabaseHas('account', [
            'email' => 'john@example.com',
            'username' => Str::upper($username),
            'sha_pass_hash' => AccountPassword::make('password', $username),
            'reg_mail' => 'john@example.com',
            'last_ip' => '127.0.0.1'
        ], 'auth');
    }

    public function testValidationFailsIfAccountNameExists()
    {
        Account::query()->where('username', 'JOHN')->firstOr(function () {
            Account::query()->create([
                'username' => 'JOHN',
                'sha_pass_hash' => '5E6F9D92F6F862EDEAEAB6ED20217D361FEAB820',
                'email' => 'john@example.com',
                'reg_mail' => 'john@example.com',
                'joindate' => now(),
                'last_login' => now(),
                'last_ip' => '127.0.0.1'
            ]);
        });

        $this->postJson('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'account_name' => 'john',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertJsonValidationErrors('account_name');
    }
}
