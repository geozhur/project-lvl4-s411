<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{

    public function testIndex()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->get(route('account.edit', $user->id));

        $response->assertStatus(200)
            ->assertSee(e($user->name));
    }

    public function testUpdateName()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->patch(route('account.update', $user->id), [
            'name' => 'Claus',
        ]);

        $user2 = User::find($user->id);
        $this->assertEquals('Claus', $user2->name);
    }

    public function testUpdateEmailWhitoutPassword()
    {

        $data = [
            'email' => 'test@www.ru',
        ];

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->patch(route('account.email.update', $user->id), $data);
        $user2 = User::find($user->id);
        $this->assertNotEquals($data['email'], $user2->email);
    }

    public function testUpdateEmailWhitPassword()
    {

        $data = [
            'email' => 'test@www.ru',
            'password_for_change_mail' => 'test',
        ];

        $user = factory(User::class)->create([
            'password' => \Hash::make($data['password_for_change_mail']),
        ]);
        $this->actingAs($user);

        $this->patch(route('account.email.update', $user->id), $data);

        $user2 = User::find($user->id);
        $this->assertEquals($data['email'], $user2->email);
    }

    public function testUpdatePasswordWhitPassword()
    {

        $data = [
            'new_password' => 'herherher',
            'confirm_new_password' => 'herherher',
            'password_for_change_password' => 'testtest',
        ];

        $user = factory(User::class)->create([
            'password' => \Hash::make($data['password_for_change_password']),
        ]);
        $this->actingAs($user);

        $this->patch(route('account.password.update', $user->id), $data);

        $user->refresh();
        $this->assertFalse(\Hash::check($data['password_for_change_password'], $user->password));
        $this->assertTrue(\Hash::check($data['new_password'], $user->password));
    }

    public function testDestroy()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);
        $response = $this->delete(route('account.destroy', $user));
        $response->assertStatus(302);

        $user2 = User::find($user->id);
        $this->assertNull($user2);
    }
}
