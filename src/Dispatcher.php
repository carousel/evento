<?php

namespace Carousel\Evento;

use Carousel\Evento\FileDoesNotExistsException;

class Dispatcher
{
    public $listeners = [];
    public $events = [];

    public static function getInstance()
    {
        return new static;
    }

    public function registerEvent($event)
    {
        $this->events[] = $event;
    }
    public function registerListener($listener)
    {
        $this->listeners[] = $listener;
    }
    public function getListenerFromConfigFile($listeners)
    {
        if (file_exists($listeners)) {
            return require $listeners;
        } else {
            throw new FileDoesNotExistsException('Event config file does not exists!');
        }
    }
    public function removeListener($listener)
    {
        foreach ($this->listeners as $key => $val) {
            if (get_class($listener) == get_class($val)) {
                unset($this->listeners[$key]);
            }
        }
    }
    public function dispatch($event)
    {
        if (count($this->listeners) != 0) {
            foreach ($this->listeners as $listener) {
                if (get_class($event) . "Listener"  == get_class($listener)) {
                    $listener->update($event);
                }
            }
        }
    }
}
