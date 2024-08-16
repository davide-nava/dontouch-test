<?php

namespace Tests\Services;

use App\Services\ProfileService;
use Tests\TestCase;

class ProfileServiceTest extends TestCase
{

    /** @test */
    public function clearPrefix()
    {
        $number = ProfileService::clearPrefix("+393333333333");

        $this->assertNotContains('+39', [$number]);
    }

}
