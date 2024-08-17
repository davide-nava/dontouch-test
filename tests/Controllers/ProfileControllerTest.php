<?php

namespace Tests\Controllers;

use Illuminate\Support\Facades\Date;
use Tests\TestCase;
use function Illuminate\Support\Facades\Date;

class ProfileControllerTest extends TestCase
{
    /** @test */
    public function test_get_response_ok()
    {
        $this->get('/api/profile');

        $this->assertResponseOk();

        $response = $this->response->getContent();
        $this->assertJson($response);
        $this->assertTrue(str_contains($response, 'numero_di_telefono'));
        $this->assertTrue(str_contains($response, 'id'));
        $this->assertTrue(str_contains($response, 'nome'));
        $this->assertTrue(str_contains($response, 'cognome'));
        $this->assertTrue(str_contains($response, 'data_di_creazione'));
        $this->assertTrue(str_contains($response, 'data_di_modifica'));
    }

    /** @test */
    public function test_get_id_response_ok()
    {
        $this->get('/api/profile/1');

        $this->assertResponseOk();

        $response = $this->response->getContent();
        $this->assertJson($response);
        $this->assertTrue(str_contains($response, 'numero_di_telefono'));
        $this->assertTrue(str_contains($response, 'id'));
        $this->assertTrue(str_contains($response, 'nome'));
        $this->assertTrue(str_contains($response, 'cognome'));
        $this->assertTrue(str_contains($response, 'data_di_creazione'));
        $this->assertTrue(str_contains($response, 'data_di_modifica'));
    }

    /** @test */
    public function test_post_response_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password"]);

        $this->post('/api/profile', ['nome' => 'aaaa', 'cognome' => 'aaaaa', 'data_di_creazione' => Date::now(), 'data_di_modifica' => Date::now(), 'numero_di_telefono' => '+39666']);

        $this->assertResponseStatus(201);
    }

    /** @test */
    public function test_put_response_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password"]);

        $this->put('/api/profile/1', ['nome' => 'aaaa', 'cognome' => 'aaaaa', 'data_di_creazione' => Date::now(), 'data_di_modifica' => Date::now(), 'numero_di_telefono' => '+39666', 'id' => '1']);

        $this->assertResponseOk();
    }

    /** @test */
    public function test_delete_response_ok()
    {
        $this->post('/api/auth/login', ["email"=> "test@example.com", "password"=> "password"]);

        $this->delete('/api/profile/2');

        $this->assertResponseOk();
    }
}
