@extends('template.app')

@section('title')
Solução
@endsection 

@section('content')

<div class="card " style="margin: 1em 6em;">
  <div class="card-header text-center">

    <span class="float-center">
        <h5> Chamado - ID {{ $os->id }}</h5>
        <h4>{{$os->titulo}}</h4>
        <p><b>Autor:</b> {{ $os->nome_autor }}</p>
    </span>
  </div>
  <div class="card-body">
    <form action="{{ route('os.solucaoStore',$os->id) }}" id="formAd" method="POST">
      @csrf

      @if(isset($user) && !empty($user))
        <input type="hidden" value="{{$user->id}}" name = "id_user">
        <div class="form-group mt-1 mb-2">
          <label for="requerente">Autor</label>
          <input type="text" id="requerente" class="form-control" value="{{$user->name}}" id="user_name" name="user_name" disabled>
        </div>
      @else
        <div class="form-group mt-1 mb-2">
          <label for="requerente">Autor</label>
          <input type="text" id="requerente" class="form-control" id="requente" name = "requerente">
        </div>
      @endif

      <div class="form-group mt-1 mb-2">
        <label for="desc">Descrição</label>
        <div class="form-floating">
          <textarea class="form-control" id="desc" placeholder="Descrição" id="descrição"  name = "descrição" style="height: 100px"></textarea>
          <label for="floatingTextarea2">Digite a solução final do atendimento</label>
        </div>
      </div>

      <div class = "col">
        <button type ='submit' class = "btn btn-primary">Salvar</button>
        <a href="{{route('os.show', $os->id)}}" class="btn btn-light border">Cancelar</a>
      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
  <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
  <script src="http://jqueryvalidation.org/files/dist
  /additional-methods.min.js"></script>

  <script src="{{ asset('js/validacao.js')}}"></script>
@endsection