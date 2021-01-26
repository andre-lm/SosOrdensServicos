@extends('template.app')

@section('title')
Meus chamados
@endsection

@section('content')

@foreach($NewOrdens as $os)
<h3 class="text-center">Novos chamados</h3>
<div class="card" style="margin: 1em 15em;">
    
    <div class="card-header text-center {{($os->status->id==1)? 'alert-success' : 'alert-warning' }}">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <span class="float-center">
            <h4> Chamado {{$os->id}} - {{$os->titulo}}</h4>
        </span>
    </div>
  <div class="card-body {{($os->status->id==1)? 'alert-success' : 'alert-warning' }}">
      <div class="row">
        <div class="text-center" >
            <p class="p-show"><b>Nome do autor da criação:</b> {{ $os->nome_autor }}</p>
            
            <p class="p-show"><b>Técnico:</b> {{ $os->userName($os->id_user) }}</p>
            <p class="p-show"><b>Situação:</b> <span class="badge {{($os->status->id==1)? 'badge-success' : (($os->status->id==2)? 'badge-warning' : 'badge-danger')}}">{{ $os->status->status }}</span></p>
            <p class="p-show"><b>Equipamento:</b> {{ $os->equipamento }}</p>
            <p class="p-show"><b>Descrição:</b> {{ $os->descrição }}</p>
           
            
            <a href="{{route('os.show', $os->id)}}" class="btn btn-light border">Visualizar</a>
        </div>
       
      </div>
    </div>
</div>
@endforeach

<br><hr><br>

@foreach($ordens as $os)
<h3 class="text-center"> Chamados em Atendimento</h3>
<div class="card" style="margin: 1em 15em;">
    <div class="card-header text-center {{($os->status->id==1)? 'alert-success' : 'alert-warning' }}">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <span class="float-center">
            <h4> Chamado {{$os->id}} - {{$os->titulo}}</h4>
        </span>
    </div>
  <div class="card-body {{($os->status->id==1)? 'alert-success' : 'alert-warning' }}">
      <div class="row">
        <div class="text-center" >
            <p class="p-show"><b>Nome do autor da criação:</b> {{ $os->nome_autor }}</p>
            
            <p class="p-show"><b>Técnico:</b> {{ $os->userName($os->id_user) }}</p>
            <p class="p-show"><b>Situação:</b> <span class="badge {{($os->status->id==1)? 'badge-success' : (($os->status->id==2)? 'badge-warning' : 'badge-danger')}}">{{ $os->status->status }}</span></p>
            <p class="p-show"><b>Equipamento:</b> {{ $os->equipamento }}</p>
            <p class="p-show"><b>Descrição:</b> {{ $os->descrição }}</p>
           
            
            <a href="{{route('os.show', $os->id)}}" class="btn btn-light border">Visualizar</a>
        </div>
       
      </div>
    </div>
</div>
@endforeach

@endsection