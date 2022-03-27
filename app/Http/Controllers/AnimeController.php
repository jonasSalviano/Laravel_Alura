<?php

namespace App\Http\Controllers;

use App\Anime;
use App\Events\NovoAnime as EventsNovoAnime;
use App\Http\Requests\AnimesFormRequest;
use App\Services\CriadorDeAnime;
use App\Services\RemovedorDeAnime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{

  public function index(Request $request)
  {
    $animes = Anime::query()->orderBy('nome')->get();
    $mensagem = $request->session()->get('mensagem');

    return view('animes.index', compact('animes', 'mensagem'));
  }

  public function create()
  {
    return view('animes.create');
  }

  public function store(AnimesFormRequest $request, CriadorDeAnime $criadorDeAnime)
  {

    $capa = null;

    if ($request->hasFile('capa')) {
      $capa = $request->file('capa')->store('anime');
    }
    
    $anime = $criadorDeAnime->criarAnime(
      $request->nome,
      $request->qtd_temporadas,
      $request->ep_por_temporada,
      $capa
    );

    $eventoNovoAnime = new EventsNovoAnime(
      $request->nome,
      $request->qtd_temporadas,
      $request->ep_por_temporada
    );

    event($eventoNovoAnime);

    $request = session()->flash('mensagem', "Anime {$anime->nome} com suas temporada e episodios foram inseridos com sucesso");

    return redirect()->route('listar_animes');
  }

  public function destroy(Request $request, RemovedorDeAnime $removedorDeAnime)
  {
    $nomeAnime = $removedorDeAnime->removerAnime($request->id);
    $request = session()->flash('mensagem', "Anime $nomeAnime removido com sucesso");

    return redirect()->route('listar_animes');
  }

  public function editaNome(int $id, Request $request)
  {
    $novoNome = $request->nome;
    $anime = Anime::find($id);
    $anime->nome = $novoNome;
    $anime->save();
  }
}
