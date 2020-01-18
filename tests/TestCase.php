<?php

namespace Tests;

use App\Enums\UserRole;
use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function asPlayer()
    {
        return $this->actingAs(
            factory(User::class)->create(['role' => UserRole::Player])
        );
    }

    public function asAdmin()
    {
        return $this->actingAs(
            factory(User::class)->create(['role' => UserRole::Admin])
        );
    }
}
