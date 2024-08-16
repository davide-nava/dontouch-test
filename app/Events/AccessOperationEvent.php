<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class AccessOperationEvent extends Event
{
    public string $operation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $operation)
    {
        $this->operation = $operation;
    }
}
