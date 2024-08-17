<?php

namespace Tests\Controllers;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Tests\TestCase;


class ProfileAttributeControllerTest extends TestCase
{
    /** @test */
    public function test_get_response_ok()
    {
        $this->get('/api/profileattribute');

        $this->assertResponseOk();

        $response = $this->response->getContent();
        $this->assertJson($response);
        $this->assertTrue(str_contains($response, 'id'));
        $this->assertTrue(str_contains($response, 'profile_id'));
        $this->assertTrue(str_contains($response, 'attribute'));
        $this->assertTrue(str_contains($response, 'data_di_creazione'));
        $this->assertTrue(str_contains($response, 'data_di_modifica'));
    }

    /** @test */
    public function test_get_id_response_ok()
    {
        $this->get('/api/profileattribute/1');

        $this->assertResponseOk();

        $response = $this->response->getContent();
        $this->assertJson($response);
        $this->assertTrue(str_contains($response, 'id'));
        $this->assertTrue(str_contains($response, 'profile_id'));
        $this->assertTrue(str_contains($response, 'attribute'));
        $this->assertTrue(str_contains($response, 'data_di_creazione'));
        $this->assertTrue(str_contains($response, 'data_di_modifica'));
    }

    /** @test */
    public function test_post_response_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password"]);

        $this->post('/api/profileattribute', ['attribute' => Str::random(10), 'profile_id' => 1, 'data_di_creazione' => Date::now(), 'data_di_modifica' => Date::now()]);

        $this->assertResponseStatus(201);
    }

    /** @test */
    public function test_put_response_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password"]);

        $this->put('/api/profileattribute/1', ['attribute' => Str::random(20), 'profile_id' => 1, 'data_di_creazione' => Date::now(), 'data_di_modifica' => Date::now(), 'id' => '1']);

        $this->assertResponseOk();
    }

    /** @test */
    public function test_delete_response_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password"]);

        $this->delete('/api/profileattribute/2');

        $this->assertResponseOk();
    }
}
