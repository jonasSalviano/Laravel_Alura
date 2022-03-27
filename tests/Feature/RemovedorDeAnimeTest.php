<?php

namespace Tests\Feature;

use App\Services\CriadorDeAnime;
use App\Services\RemovedorDeAnime;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeAnimeTest extends TestCase
{
    use RefreshDatabase;
    /**@var Anime */
    private $anime;

    public function setUp(): void
    {
        parent::setUp();
        $criadorDeAnime = new CriadorDeAnime();
        $this->anime = $criadorDeAnime->criarAnime('Nome do Anime', 1, 1);
    }

    public function testRemoverUmAnime()
    {
        $this->assertDatabaseHas('animes', ['id' => $this->anime->id]);
        $removedorDeAnime = new RemovedorDeAnime();
        $nomeAnime = $removedorDeAnime->removerAnime($this->anime->id);
        $this->assertIsString($nomeAnime);
        $this->assertEquals('Nome do Anime', $this->anime->nome);
        $this->assertDatabaseMissing('animes', ['id' => $this->anime->id]);
    }
}
