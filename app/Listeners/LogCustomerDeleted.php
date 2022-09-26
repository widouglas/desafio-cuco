<?php

namespace App\Listeners;

use App\Events\CustomerDeleted;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogCustomerDeleted implements ShouldQueue
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
    public function handle(CustomerDeleted $event)
    {
        Log::info("Cliente {$event->customerCpf} - {$event->customerName} deletado com sucesso");
    }
}
