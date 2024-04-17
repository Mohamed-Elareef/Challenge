<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\StringController;

class StringControllerTest extends TestCase
{
    /** @test */
    public function test_valid_strings()
    {
        $controller = new StringController();

        $this->assertTrue($controller->isValidString("{([])}"));
        $this->assertTrue($controller->isValidString("{}"));
    }

    /** @test */
    public function test_invalid_strings()
    {
        $controller = new StringController();

        $this->assertFalse($controller->isValidString("{[}]"));
        $this->assertFalse($controller->isValidString("{)"));
    }
}
