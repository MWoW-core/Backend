<?php

namespace Tests\Unit\Rules;

use App\Rules\ValidHostname;
use App\Rules\ValidScriptName;
use App\Scripts\CreateAccountScript;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidHostnameTest extends TestCase
{
    protected ValidHostname $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new ValidHostname;
    }

    public function validHostnames(): array
    {
        return [
            ['127.0.0.1'],
            ['google.com'],
            ['example.com']
        ];
    }

    public function invalidHostnames(): array
    {
        return [
            ['htt://www.zone24x7.com'],
            ['://www.zone24x7.com'],
            ['192.168.1.1.1']
        ];
    }

    /**
     * @dataProvider invalidHostnames
     * @param string $hostname
     */
    public function testItFailsTheInvalidHostnames(string $hostname)
    {
        self::assertFalse(
            $this->rule->passes('testing', $hostname),
            "{$hostname} unexpectedly passed hostname validation"
        );
    }

    /**
     * @dataProvider validHostnames
     * @param string $hostname
     */
    public function testItPassesTheValidHostnames(string $hostname)
    {
        self::assertTrue(
            $this->rule->passes('testing', $hostname),
            "{$hostname} did not pass hostname validation"
        );
    }
}
