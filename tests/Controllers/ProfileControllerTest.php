<?php

namespace Tests\Controllers;

use Tests\BaseTestCase;

class ProfileControllerTest extends BaseTestCase
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
