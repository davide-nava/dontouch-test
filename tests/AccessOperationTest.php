<?php

namespace Tests;

class AccessOperationTest extends TestCase
{
    /** @test */
    public function check_logs_access_contains_called_path()
    {
        $path = dirname(__DIR__, 1) . '\app\storage\logs\access.log';

        $file = file_get_contents($path);

        $this->assertNotNull($file );
    }

    /** @test */
    public function check_logs_access_file_exist()
    {
        $path = dirname(__DIR__, 1) . '\app\storage\logs\access.log';

        $this->get('/');

        $this->assertResponseOk();

        $this->assertFileExists($path);
    }
}
