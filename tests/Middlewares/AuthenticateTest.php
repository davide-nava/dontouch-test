<?php

namespace Tests\Middlewares;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function test_get_endpoint_return_ok()
    {
        $this->get('/api/profile');

        $this->assertResponseOk();
    }

    /** @test */
    public function test_post_endpoint_return_401()
    {
        $this->delete('/api/profile/1');

        $this->assertResponseStatus(401);
    }
}
