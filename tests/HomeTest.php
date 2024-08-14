<?php

namespace Tests;

class HomeTest extends BaseTestCase
{
    /** @test */
    public function root_endpoint_return_200()
    {
        $this->get('/');

        $this->assertResponseStatus(200);
    }
}
