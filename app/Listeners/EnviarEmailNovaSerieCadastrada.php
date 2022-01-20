<?php

namespace App\Listeners;

use App\Mail\NovaSerie;
use App\Events\SerieNova;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmailNovaSerieCadastrada implements ShouldQueue
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
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(SerieNova $event)
    {
        $nomeSerie = $event->nomeSerie;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;
        $users = User::all();

        foreach($users as $indice => $user)
        {
            $multiplicador = $indice + 1;
            $email = new NovaSerie(
                $nomeSerie,
                $qtdTemporadas,
                $qtdEpisodios 
             );
             $email->subject('Nova série adicionada.');
             $when = now()->addSeconds($multiplicador * 5);
         
             \Illuminate\Support\Facades\Mail::to($user)->later($when,$email);
             
        }
    }
}
