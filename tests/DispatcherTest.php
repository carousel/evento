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
        $this->dispatcher = Dispatcher::getInstance();
    }
    /**
     * @test
     */
    public function dispatcherCanBeInstantiated()
    {
        $this->assertInstanceOf('Carousel\Evento\Dispatcher', $this->dispatcher);
    }
    /**
     * @test
     */
    public function dispatcherCanDispatchEvent()
    {
        $listener = new UserCreatedListener;
        $this->dispatcher->subscribe($listener);
        $this->dispatcher->registerEvent(new UserCreated);
        $event = new UserCreated;
        $this->dispatcher->dispatch($event);
        $this->assertEquals($listener->message, 'Notified!!!');
    }
    /**
     * @test
     */
    public function listenerCabBeRemoved()
    {
        $listener = new UserCreatedListener;
        $this->dispatcher->subscribe($listener);
        $this->assertTrue(in_array($listener, $this->dispatcher->listeners));
        $this->dispatcher->unsubscribe($listener);
        $this->assertFalse(in_array($listener, $this->dispatcher->listeners));
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
