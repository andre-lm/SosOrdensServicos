@extends('template.app')

@section('title')
Chamados
@endsection

@section('content')
<div class="card" style="margin: 1em;">
  <div class="card-body col-12">
      @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      <div class="text-center text-secondary mb-1">
          {{'Total de '.$count.' registros - Exibindo '.$ordemservico->count().' por página'}}
      </div>

    <table class="table table-hover">
      @if (session('status'))
        <div class="alert alert-successmt-1 mb-1 p-2 ">
            {{ session('status') }}
        </div>
      @endif

      <thead class="">
          <tr> 
              <th>ID</th>
              <th>Aberto por:</th>
              <TH>Título</TH>
              <th>Atribuído para técnico</th>
              <th>Equipamento</th>
              <th>Situação</th>
              <th>Data de Abertura</th>
              <th colspan ="100%">Ações</th>
          </tr>
      </thead>
      <tbody align = 'left'>
          @foreach($ordemservico as $os)
              <tr>
                  <td>{{ $os->id }}</td>
                  <td>{{ $os->nome_autor }}</td>
                  <td>{{ $os->titulo }}</td>
                  <td>{{ $os->userName($os->id_user) }}</td>
                  <td>{{ $os->equipamento }}</td>
                  <td>{{ $os->status->status }}</td>
                  @php
                  $result = new DateTime($os->created_at);
                  $created_at = $result->format("d/m/Y");
                  @endphp
                  <td>{{ $created_at }}</td>
                  <td>
                    <a href="{{route('os.show', $os->id)}}" class="btn btn-light border">Visualizar</a>
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  <div class="os-footer">
          {{$ordemservico->links()}}
  </div>
</div>

@endsection