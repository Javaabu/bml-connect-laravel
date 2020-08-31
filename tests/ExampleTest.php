<?php

namespace Javaabu\BmlConnect\Tests;

use Orchestra\Testbench\TestCase;
use Javaabu\BmlConnect\BmlConnectServiceProvider;

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
