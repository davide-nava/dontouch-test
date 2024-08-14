<?php

namespace Tests;

abstract class BaseTestCase extends \Laravel\Lumen\Testing\TestCase
{
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }
}
