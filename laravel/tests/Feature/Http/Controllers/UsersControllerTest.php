<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_new_users_can_register(): void
    {
        $response = $this->post('api/register', [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
        ]);
        $this->assertAuthenticated();
        $response->assertJson([
            'created' => true,
        ]);
    }
}
