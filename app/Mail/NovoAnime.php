<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovoAnime extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $qtdTemporada;
    public $qtdEpisodios;

    public function __construct($nome, $qtdTemporada, $qtdEpisodios)
    {
        $this->nome = $nome;
        $this->qtdTemporada = $qtdTemporada;
        $this->qtdEpisodios = $qtdEpisodios;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.anime.novo-anime');
    }
}
