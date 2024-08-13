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
        $log = new Logger('AccessOperation');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../../app/storage/logs/access.log'));

        $log->info($event->operation);
    }
}
