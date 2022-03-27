<?php

namespace App\Services;

use App\Anime;
use App\Episodio;
use App\Events\AnimeApagado;
use App\Jobs\ExcluirCapaAnime;
use App\Temporada;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemovedorDeAnime
{
    public function removerAnime(int $animeId): string
    {
        $nomeAnime = '';
        DB::transaction(function () use ($animeId, &$nomeAnime) {
            $anime = Anime::find($animeId);
            $animeObj = (object)$anime->toArray();
            $nomeAnime = $anime->nome;
            $this->removerTemporadas($anime);
            $anime->delete();

            $evento = new AnimeApagado($animeObj);
            event($evento);
            ExcluirCapaAnime::dispatch($animeObj);
        });

        return $nomeAnime;
    }

    private function removerTemporadas(Anime $anime)
    {
        $anime->temporadas->each(function (Temporada $temporada) {
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }
}
