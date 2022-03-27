<?php

namespace App\Services;

use App\Anime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CriadorDeAnime
{
    public function criarAnime(string $nomeAnime, int $qtdTemporada, int $epPorTemporada, ?string $capa): Anime
    {
        DB::beginTransaction();
        $anime = Anime::create([
            'nome' => $nomeAnime,
            'capa' => $capa
        ]);
        $this->criaTemporada(
            $qtdTemporada,
            $epPorTemporada,
            $anime
        );
        DB::commit();

        return $anime;
    }

    public function criaTemporada(int $qtdTemporada, int $epPorTemporada, Anime $anime)
    {
        for ($i = 1; $i <= $qtdTemporada; $i++) {
            $temporada = $anime->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    public function criaEpisodios(int $epPorTemporada, Model $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
