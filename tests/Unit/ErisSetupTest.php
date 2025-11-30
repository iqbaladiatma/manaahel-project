<?php

namespace Tests\Unit;

use Eris\Generator;
use Eris\TestTrait;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ErisSetupTest extends TestCase
{
    use TestTrait;

    /**
     * Test that Eris is properly installed and working.
     */
    #[Test]
    public function eris_is_properly_configured()
    {
        $this->forAll(
            Generator\int()
        )->then(function ($number) {
            $this->assertIsInt($number);
        });
    }

    /**
     * Test that Eris can generate strings.
     */
    #[Test]
    public function eris_can_generate_strings()
    {
        $this->forAll(
            Generator\string()
        )->then(function ($string) {
            $this->assertIsString($string);
        });
    }
}
