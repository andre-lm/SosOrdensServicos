@extends('template.app')

@section('title')
Visualizar chamado
@endsection

@section('content')

<div class="card " style="margin: 0.5em 6em;">
    
    <div class="card-header text-center">
        <span class="float-center">
            <h5> Chamado - ID {{ $os->id }}</h5>
            <h4>{{$os->titulo}}</h4>
        </span>
    </div>
  <div class="card-body">
      <div class="row">
        <div class="col-6" >
            <p class="p-show"><b>Nome do autor da criação:</b> {{ $os->nome_autor }}</p>
            <p class="p-show"><b>Título:</b> {{ $os->titulo }}</p>
            <p class="p-show"><b>Técnico:</b> {{ $os->userName($os->id_user) }}</p>
            <p class="p-show"><b>Situação:</b> <span class="badge {{($os->status->id==1)? 'badge-success' : (($os->status->id==2)? 'badge-warning' : 'badge-danger')}}">{{ $os->status->status }}</span></p>
            <p class="p-show"><b>Equipamento:</b> {{ $os->equipamento }}</p>
            <p class="p-show"><b>Descrição:</b> {{ $os->descrição }}</p>
            <p class="p-show"><b>Data de criação:</b> {{ dateToPTBR($os->created_at) }}</p>
            <a href="{{ route('os.acompanhamento', $os->id) }}" class="btn btn-secondary">Acompanhamento</a>
            <a href="{{ route('os.solucao', $os->id) }}" class = "btn btn-success">Solução</a>
            <a href="{{ route('os.edit', $os->id) }}" class = "btn btn-primary">Editar</a>
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

            @foreach($os->Acompanhamento as $acomp)
                <div class="collapse show-acomp" id="acomp">
                    <blockquote class="blockquote d-block">
                        <footer class="blockquote-footer"><b>Requerente: </b>{{($acomp->id_user) ? $acomp->userName($acomp->id_user) : $acomp->requerente}}</footer>
                        <footer class="blockquote-footer"><b>Descrição: </b>{{$acomp->descricao}} </footer>
                        <footer class="blockquote-footer"><b>Data: </b>{{ dateToPTBR($acomp->created_at)}} </footer>
                    </blockquote>
                </div>
            @endforeach

            @foreach($os->Solucao as $solucao)
            <div class="collapse show-solucao" id="solucao">
                <blockquote class="blockquote d-block">
                    <footer class="blockquote-footer"><b>Requerente: </b>{{($solucao->id_user) ? $solucao->userName($solucao->id_user) : $solucao->requerente}}</footer>
                    <footer class="blockquote-footer"><b>Descrição: </b>{{$solucao->descricao}} </footer>
                    <footer class="blockquote-footer"><b>Data: </b>{{ dateToPTBR($solucao->created_at)}} </footer>
                </blockquote>
                  
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