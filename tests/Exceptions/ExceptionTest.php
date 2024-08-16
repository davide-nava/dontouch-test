<?php

namespace Tests\Exceptions;

use Tests\TestCase;


class ExceptionTest extends TestCase
{
    /** @test */
    public function test_wrong_endpoint_return_404()
    {
        $this->get('/aaaaaaaa');

        $this->assertResponseStatus(404);
    }
}
