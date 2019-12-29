<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }
}
