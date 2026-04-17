<?php

namespace App\Listeners;

use App\Events\aproveCatigory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class notifyAproveCatigory
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(aproveCatigory $event): void
    {
        //
    }
}
