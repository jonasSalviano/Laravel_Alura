@extends('layout')

@section('cabecalho')
Animes
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])
@auth
<a href="{{ route('criar_anime') }}" class="btn btn-dark mb-2">Adicionar</a>
@endauth

<ul class="list-group">
    @foreach($animes as $anime)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <img src="{{$anime->capa_url}}" class="img-thumbnail" height="150px" width="150px">
            <span id="nome-anime-{{ $anime->id }}">{{ $anime->nome }}</span>
        </div>

        <div class="input-group w-50" hidden id="input-nome-anime-{{ $anime->id }}">
            <input type="text" class="form-control" value="{{ $anime->nome }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editaNome({{ $anime->id }})">
                    <i class="fas fa-check"></i>
                </button>
                @csrf
            </div>
        </div>
        <span class="d-flex">
            @auth
            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $anime->id }})">
                <i class="fas fa-edit"></i>
            </button>
            @endauth
            <a href="/animes/{{$anime->id}}/temporadas" class="btn btn-info btn-sm mr-1">
                <i class="fas fa-external-link-alt"></i>
            </a>
            @auth
            <form method="post" action="/animes/{{$anime->id}}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $anime->nome )}}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    <i class="far fa-trash-alt"></i>
                </button>
            </form>
            @endauth
        </span>
    </li>
    @endforeach
</ul>

<script>
    function toggleInput(animeId) {

        if (document.getElementById(`nome-anime-${animeId}`).hasAttribute('hidden')) {
            document.getElementById(`nome-anime-${animeId}`).removeAttribute('hidden');
            document.getElementById(`input-nome-anime-${animeId}`).hidden = true;
        } else {
            document.getElementById(`input-nome-anime-${animeId}`).removeAttribute('hidden');
            document.getElementById(`nome-anime-${animeId}`).hidden = true;
        }

    }

    function editaNome(animeId) {

        let formData = new FormData();
        const nome = document.querySelector(`#input-nome-anime-${animeId} > input`).value;
        const token = document.querySelector('input[name = "_token"]').value;

        formData.append('nome', nome);
        formData.append('_token', token);

        const url = `/animes/${animeId}/editaNome`;

        fetch(url, {
            body: formData,
            method: 'POST'
        }).then(() => {
            toggleInput(animeId);
            document.getElementById(`nome-anime-${animeId}`).textContent = nome;
        });

    }
</script>
@endsection