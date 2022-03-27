<?php

namespace App\Listeners;

use App\Events\NovoAnime;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class LogNovoAnimeCadastrado implements ShouldQueue
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
     * @param  NovoAnime  $event
     * @return void
     */
    public function handle(NovoAnime $event)
    {
        $nomeAnime = $event->nomeAnime;
        $qtdTemporadas = $event->qtdTemporadas;
        $qtdEpisodios = $event->qtdEpisodios;
        Log::info('Anime novo cadastrado ' . $nomeAnime . ', com '. $qtdTemporadas . ' Temporadas e '. $qtdEpisodios . ' episodios');
    }
}
