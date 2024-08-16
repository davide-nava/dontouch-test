<?php

namespace Tests\Controllers;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /** @test */
    public function test_login_return_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password"]);

        $this->assertResponseOk();
    }

    /** @test */
    public function test_login_wrong_password_return_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password22"]);

        $this->assertResponseStatus(401);
    }
}
