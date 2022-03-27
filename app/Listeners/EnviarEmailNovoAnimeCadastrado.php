<?php

namespace App\Listeners;

use App\Events\NovoAnime;
use App\Mail\NovoAnime as MailNovoAnime;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EnviarEmailNovoAnimeCadastrado
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
        $useres = User::all();
        foreach ($useres as $indice => $user) {
          $multiplicador = $indice + 1;
          $email = new MailNovoAnime(
            $nomeAnime,
            $qtdTemporadas,
            $qtdEpisodios
          );
          $email->subject = 'Novo Anime Adicionado';
          $quando = now()->addSecond($multiplicador * 5);
          Mail::to($user)->later($quando,$email);
        }
    }
}
