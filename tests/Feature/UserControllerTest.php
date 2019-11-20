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

    public function testUserPagination()
    {
        factory('App\User', 50)->create();
        $thisPage = (new \App\User())->paginate();
        $this->assertEquals(15, $thisPage->count());
    }
}
