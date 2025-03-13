<?php

namespace Javaabu\BmlConnect\Tests;


use Illuminate\Support\Facades\App;
use Javaabu\BmlConnect\BmlConnect;

class BmlConnectTest extends TestCase
{

    /** @test */
    public function it_can_make_a_bml_connect_instance()
    {
        $bml_connect = App::make('bml-connect');

        $this->assertInstanceOf(BmlConnect::class, $bml_connect);
    }
}
