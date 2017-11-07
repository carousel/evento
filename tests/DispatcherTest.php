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
     * Test that dispatcher can dispatch event
     *
     * @test
     */
    public function dispatcherCanDispatchEvent()
    {
        $listener = new UserCreatedListener;
        $this->dispatcher->registerListener($listener);
        $this->dispatcher->registerEvent(new UserCreated);
        $event = new UserCreated;
        $this->dispatcher->dispatch($event);
        $this->assertEquals($listener->message, 'Notified!!!');
    }
}

class UserCreated extends AbstractEvent
{
    public $message = "Notified!!!";
    public function publish()
    {
        $this->dispatcher->dispatch($this);
    }
}
class UserCreatedListener
{
    public $message;
    public function update($event)
    {
        $this->message = $event->message;
    }
}
