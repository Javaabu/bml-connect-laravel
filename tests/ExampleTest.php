<?php

namespace Javaabu\BmlConnect\Tests;

use Javaabu\BmlConnect\Providers\BmlConnectServiceProvider;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BmlConnectServiceProvider::class];
    }

    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
