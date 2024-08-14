<?php

namespace Tests;

class AccessOperationTest extends BaseTestCase
{
    /** @test */
    public function check_logs_access_contains_called_path()
    {
        unlink(realpath('../../storage/logs/access.log'));

        $this->get('/');
        $this->get('/api/profile');

        $file = file_get_contents('../../storage\logs\access.log');

        $this->assertTrue(str_contains($file, 'http://localhost:8000/api/profile') && str_contains($file, 'http://localhost:8000/api/profile'), $file);
    }

    /** @test */
    public function check_logs_access_file_exist()
    {
        unlink('../../storage/logs/access.log');

        $this->get('/');

        $this->assertFileExists('../../storage/logs/access.log');
    }
}
