<?php

namespace App\Listeners;

use App\Events\CustomerCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogCustomerCreated implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle(CustomerCreated $event)
    {
        Log::info("Cliente {$event->customerCpf} - {$event->customerName} cadastrado com sucesso");
    }
}
