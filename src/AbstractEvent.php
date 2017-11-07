<?php

namespace Carousel\Evento;

use Carousel\Evento\Dispatcher;

abstract class AbstractEvent
{
    public function __construct()
    {
        $this->dispatcher = Dispatcher::getInstance();
    }
    
    abstract protected function publish();
}
