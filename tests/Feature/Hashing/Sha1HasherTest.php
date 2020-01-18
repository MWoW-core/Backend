<?php

namespace Tests\Feature\Hashing;

use Tests\TestCase;
use App\Hashing\Sha1Hasher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class Sha1HasherTest extends TestCase
{
    public function testItResolvesASha1HasherInstance()
    {
        self::assertInstanceOf(
            Sha1Hasher::class,
            Hash::driver('sha1')
        );
    }

    public function testItEncryptsTheValue()
    {
        self::assertEquals(
            'FC905A78FB9ED15382891C8B265B238E3DF6C948',
            (new Sha1Hasher)->make('secret', ['name' => 'admin'])
        );
    }
}
