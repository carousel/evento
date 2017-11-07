<?php

namespace Carousel\Evento;

class Dispatcher
{
    public $listeners = [];
    public $events = [];

    public function registerEvent($event)
    {
        $this->events[] = $event;
    }
    public function registerListener($listener)
    {
        $this->listeners[] = $listener;
    }
    public function removeListener($listener)
    {
            foreach ($this->listeners as $key => $val) {
                if(get_class($listener) == get_class($val)){
                    unset($this->listeners[$key]);
                }
            }
    }
    public function dispatch($event)
    {
        if (count($this->listeners) != 0) {
            foreach ($this->listeners as $listener) {
                if(get_class($event) . "Listener"  == get_class($listener)){
                    $listener->update($event);
                }
            }
        }
    }
}
