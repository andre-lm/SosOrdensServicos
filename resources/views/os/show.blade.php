@extends('template.app')

@section('title')
Visualizar chamado 
@endsection

@section('breadcrumb')
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('os.index')}}">OS</a></li>
  <li class="breadcrumb-item active">Chamado {{$os->id}}</li>
</ol>
@endsection

@section('content')

<div class="card " style="margin: 1em 0;">
    
    <div class="card-header text-center">
        <span class="float-center">
            <h5> Chamado - {{ $os->titulo }}</h5>
        </span>
    </div>
  <div class="card-body">
      <div class="row">
        <div class="col-6" >
            <p class="p-show"><b>Nome do autor da criação:</b> {{ $os->nome_autor }}</p>
            <p class="p-show"><b>Título:</b> {{ $os->titulo }}</p>
            <p class="p-show"><b>Técnico:</b> {{ $os->userName($os->id_user) }}</p>
            <p class="p-show"><b>Situação:</b> <span class="os_status badge {{($os->status->id==1)? 'badge-success' : (($os->status->id==2)? 'badge-warning' : 'badge-danger')}}">{{ $os->status->status }}</span></p>
            <p class="p-show"><b>Equipamento:</b> {{ $os->equipamento }}</p>
            <p class="p-show"><b>Descrição:</b> {{ $os->descrição }}</p>
            <p class="p-show"><b>Data de criação:</b> {{ datetimeToPTBR($os->created_at) }}</p>
            <a href="{{ route('os.acompanhamento', $os->id) }}" class="btn btn-secondary">Acompanhamento</a>
            <a href="{{ route('os.solucao', $os->id) }}" class = "btn btn-success">Solução</a>
            <a href="{{ route('os.edit', $os->id) }}" class = "btn btn-primary">Editar</a>
            @csrf
            <input type="hidden" class="os_id" value="{{$os->id}}">
            <button class="btn btn-danger js-del">Excluir</button>
        </div>
        <div class="col-6 text-center" style="border-radius:0.25rem">

            <p>
                @if(isset($os->Acompanhamento[0]))
                <button type="button" class="border acompanhamento btn btn-default" 
                    data-toggle="collapse" data-target=".show-acomp">         
                    <b>Acompanhamentos</b>
                </button>
                @endif
                @if(isset($os->Solucao[0]))
                <button type="button" class="border solucao btn btn-default" 
                    data-toggle="collapse" data-target=".show-solucao">         
                    <b>Solução</b>
                </button>
                @endif
            </p>

            @foreach($os->Acompanhamento as $key => $acomp)
                <div class="collapse show-acomp" id="acomp">
                    <div class="row">
                        <blockquote class="blockquote col-10">
                            <footer class="blockquote-footer"><b>Requerente: </b>{{($acomp->id_user) ? $acomp->userName($acomp->id_user) : $acomp->requerente}}</footer>
                            <footer class="blockquote-footer"><b>Descrição: </b>{{$acomp->descricao}} </footer>
                            <footer class="blockquote-footer"><b>Data: </b>{{ datetimeToPTBR($acomp->created_at)}} </footer>
                        </blockquote>
                        <div class="col-2 acomp p-0 mt-3">
                            @csrf
                            <input type="hidden" class="acomp_id" value="{{$acomp->id}}">
                            <button class="btn btn-sm btn-danger js-del">Excluir</button>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach($os->Solucao as $solucao)
            <div class="collapse show-solucao" id="solucao">
                <div class="row">
                    <blockquote class="blockquote d-block col-10">
                        <footer class="blockquote-footer"><b>Requerente: </b>{{($solucao->id_user) ? $solucao->userName($solucao->id_user) : $solucao->requerente}}</footer>
                        <footer class="blockquote-footer"><b>Descrição: </b>{{$solucao->descricao}} </footer>
                        <footer class="blockquote-footer"><b>Data: </b>{{ datetimeToPTBR($solucao->created_at)}} </footer>
                    </blockquote>
                    <div class="col-2 sol p-0 mt-3">
                        @csrf
                        <input type="hidden" class="sol_id" value="{{$solucao->id}}">
                        <button class="btn btn-sm btn-danger js-del">Excluir</button>     
                    </div>
                </div> 
            </div>
            @endforeach
        </div>
      </div>
    </div>
</div>
<div class="text-center">
    <span class="float-center">
        <a href="{{url('os/')}}" class="btn btn-light border">Voltar</a>
    </span>
</div>

@endsection