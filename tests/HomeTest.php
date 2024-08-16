<?php

namespace Tests;

class HomeTest extends TestCase
{
    /** @test */
    public function test_root_endpoint_return_200()
    {
        $this->get('/');

        $this->assertResponseOk();
    }
}
