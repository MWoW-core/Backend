<?php

namespace Tests\Unit;

use Tests\CreatesApplication;
use App\Rules\ValidMorphMapKey;
use PHPUnit\Framework\TestCase;

class ValidMorphMapKeyTest extends TestCase
{
    use CreatesApplication;

    protected ValidMorphMapKey $rule;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        $this->createApplication();

        $this->rule = new ValidMorphMapKey;
    }

    public function testRulePassesAValidMorphMapKey()
    {
        self::assertTrue(
            $this->rule->passes('attribute', 'News')
        );
    }

    public function testRuleFailsAnInvalidMorphMapKey()
    {
        self::assertFalse(
            $this->rule->passes('attribute', 'Invalid')
        );
    }
}
