<?php

namespace Tests;

class AccessOperationTest extends BaseTestCase
{
    /** @test */
    public function check_logs_access_contains_called_path()
    {
        $path = dirname(__DIR__, 1) . '\app\storage\logs\access.log';

        unlink($path);

        $this->get('/');
        $this->get('/api/profile');

        $file = file_get_contents($path);

        $this->assertTrue(str_contains($file, 'http://localhost/api/profile') && str_contains($file, 'http://localhost/api/profile'), $file);
    }

    /** @test */
    public function check_logs_access_file_exist()
    {
        $path = dirname(__DIR__, 1) . '\app\storage\logs\access.log';

        unlink($path);

        $this->get('/');

        $this->assertFileExists($path);
    }
}
