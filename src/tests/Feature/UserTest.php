<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function testShouldBeAbleToCreateUserWithSuccess(): void
    {

        $this->assertTrue(true);
    }
}
