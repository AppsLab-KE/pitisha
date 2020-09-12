<?php


namespace Reviewable\Tests\Feature;

use Reviewable\Tests\TestCase;

class ModelFeatureTest extends TestCase
{
    public function testIsWorking()
    {
        $this->assertTrue(true);
    }

    public function testCanCreateRole()
    {
        $role = new Review();
    }
}