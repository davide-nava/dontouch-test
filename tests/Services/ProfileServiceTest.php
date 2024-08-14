<?php

namespace Tests\Services;

use App\Repositories\ProfileRepositoryInterface;
use App\Services\ProfileService;
use Tests\BaseTestCase;
use Mockery\MockInterface;

class ProfileServiceTest extends BaseTestCase
{
    /** @test */
    public function create()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    /** @test */
    public function clearPrefix()
    {
        $mock = $this->mock(ProfileRepositoryInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('process')->once();
        });

        $mock->
        $service = new ProfileService();

        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    /** @test */
    public function update()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    /** @test */
    public function delete()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    /** @test */
    public function all()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    /** @test */
    public function find()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }
}
