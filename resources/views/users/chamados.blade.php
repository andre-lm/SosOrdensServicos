@extends('template.app')

@section('title')
Meus chamados
@endsection

@section('content')

@if(!isset($NewOrdens[0]) && !isset($ordens[0]))
<h3 class="text-center mt-4">Nenhum chamado em aberto</h3>
@endif

@if(isset($NewOrdens[0]))
<h3 class="text-center mt-4">Novos chamados</h3>
@endif
@foreach($NewOrdens as $os)
<div class="card" style="margin: 1em 15em;">
    
    <div class="card-header text-center {{($os->status->id==1)? 'alert-success' : 'alert-warning' }}">
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


@if(isset($ordens[0]))
<hr class="mt-4 mb-3">
<h3 class="text-center mt-2"> Chamados em Atendimento</h3>
@endif
@foreach($ordens as $os)
<div class="card" style="margin: 1em 15em;">
    <div class="card-header text-center {{($os->status->id==1)? 'alert-success' : 'alert-warning' }}">
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