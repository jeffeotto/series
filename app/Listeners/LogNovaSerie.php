<?php

namespace App\Listeners;

use App\Events\SerieNova;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogNovaSerie implements ShouldQueue
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
     * @param  SerieNova  $event
     * @return void
     */
    public function handle(SerieNova $event)
    {
        $nome = $event->nomeSerie;
        Log::info('Nova série'. $nome);
    }
}
