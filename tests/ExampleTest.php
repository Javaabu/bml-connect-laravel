<?php

namespace Javaabu\BmlConnectLaravel\Tests;

use Orchestra\Testbench\TestCase;
use Javaabu\BmlConnectLaravel\BmlConnectLaravelServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [BmlConnectLaravelServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
