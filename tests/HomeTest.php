<?php

namespace Tests;

class HomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function root_endpoint_return_200()
    {
        $this->get('/');

        $this->assertResponseStatus(200);
    }
}
