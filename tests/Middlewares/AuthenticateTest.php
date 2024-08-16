<?php

namespace Tests\Middlewares;

use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function test_that_base_endpoint_returns_a_successful_response()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }
}
