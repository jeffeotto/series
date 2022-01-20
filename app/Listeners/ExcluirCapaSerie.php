<?php

namespace App\Listeners;

use App\Events\SerieApagada;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExcluirCapaSerie
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
     * @param  SerieApagada  $event
     * @return void
     */
    public function handle(SerieApagada $event)
    { 
        $serie = $event->serie;
        if ($serie->thumbnail) {
            Storage::delete($serie->thumbnail);
        }
    }
}
