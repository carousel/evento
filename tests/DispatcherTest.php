<?php

namespace Carousel\Evento;

use Carousel\Evento\Dispatcher;

class DispatcherTest extends \PHPUnit\Framework\TestCase
{
    /**
    * Inject dispatcher instance for testing
    */
    public function setUp()
    {
        $this->dispatcher = new Dispatcher;
    }
    /**
     * Test that dispatcher instance exists
     *
     * @test
     */
    public function dispatcherCanBeInstantiated()
    {
        $this->assertInstanceOf('Carousel\Evento\Dispatcher', $this->dispatcher);
    }
    /**
     * Test that dispatcher instance exists
     *
     * @test
     */
    public function dispatcherCanEchoPhrase()
    {
        $this->assertEquals('Hello Dispatcher', $this->dispatcher->echoPhrase('Hello Dispatcher'));
    }
}
