<?php

namespace App\Listeners;

use App\Events\AccessOperationEvent;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

class AccessOperationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\AccessOperationEvent $event
     * @return void
     */
    public function handle(AccessOperationEvent $event)
    {
        $path = dirname(__DIR__, 1) . '\storage\logs\access.log';
        $log = new Logger('AccessOperation');
        $log->pushHandler(new StreamHandler($path));

        $log->info($event->operation);
    }
}
