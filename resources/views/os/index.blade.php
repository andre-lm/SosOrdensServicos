@extends('template.app')

@section('title')
Chamados
@endsection

@section('content')
<div class="card" style="margin: 1em 0;">
  <div class="card-body col-12">

      <div class="text-center text-secondary mb-1">
          <a class="btn btn-secondary mb-3" href="{{ route('os.create') }}">Cadastrar Chamado</a>
          <a class="btn btn-success mb-3" href="{{ route('os.export') }}">Exportar xls</a>
          <br>
          {{'Total de '.$count.' registros - Exibindo '.$ordemservico->count().' por página'}}
      </div>

    <div class="table-responsive">
    <table class="table table-hover table-bordered" width="100%" cellspacing="0">
      <thead>
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
      <tfoot>
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
    </tfoot>
      <tbody align = 'left'>
          @foreach($ordemservico as $os)
              <tr>
                  <td>{{ $os->id }}</td>
                  <td>{{ $os->nome_autor }}</td>
                  <td>{{ $os->titulo }}</td>
                  <td>{{ $os->userName($os->id_user) }}</td>
                  <td>{{ $os->equipamento }}</td>
                  <td><span class="badge {{($os->status->id==1)? 'badge-success' : (($os->status->id==2)? 'badge-warning' : 'badge-danger')}}">{{ $os->status->status }}</span></td>
                  <td>{{ dateToPTBR($os->created_at) }}</td>
                  <td>
                    <a href="{{route('os.show', $os->id)}}" class="btn btn-light border">Visualizar</a>
                  </td>
              </tr>
          @endforeach
      </tbody>
    </table>
    </div>
  </div>
  <div class="os-footer">
          {{$ordemservico->links()}}
  </div>
</div>

@endsection