@extends('template.app')

@section('title')
Criar chamado
@endsection

@section('breadcrumb')
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('os.index')}}">OS</a></li>
  <li class="breadcrumb-item active">Criar chamado</li>
</ol>
@endsection

@section('content')

<div class="card " style="margin: 1em 0; padding:10px">

   
    <form action="{{ route('os.store') }}" id="formOS" method="POST">

      @csrf
        <div class="row">
          <div class="form-group mt-1 mb-2 col-6">
            <input type="text" class="form-control" placeholder="Autor" value="{{(!empty($user)&&$user->name) ? $user->name : ''}}" aria-label="Autor" id="nome_autor" name="nome_autor">
          </div>

          <div class="form-group mt-1 mb-2 col-6">
            <select class="form-select" id="atribuido_tecnico" name="atribuido_tecnico" aria-label="Técnico atribuído" >
              <option value="" selected>Escolha o técnico</option>
              @foreach(findTecnicos() as $id => $nome)
                <option value="{{$id}}">{{$nome}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group mt-1 mb-2">
          <input type="text" class="form-control" placeholder="Nome do Equipamento" aria-label="Nome do Equipamento" id="equipamento" name="equipamento">
        </div>
     
        <div class="form-group mt-1 mb-2">
          <input type="text" class="form-control" placeholder="Titulo" aria-label="Titulo" id="titulo" name = "titulo">
        </div>
        
        <div class="form-group mt-1 mb-2 form-floating">
            <textarea class="form-control" placeholder="Descrição" id="descrição" name="descrição" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Descrição</label>
        </div>
        <br>
          <div class = "col text-center">
           <button type ='submit' class = "btn btn-primary">Salvar</button>
           <a href="{{route('os.index')}}" class="btn btn-light border">Cancelar</a>
          </div>
    </form>
</div>
@endsection

@section('scripts')
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script src="http://jqueryvalidation.org/files/dist
/additional-methods.min.js"></script>

<script src="{{ asset('js/validacao.js')}}"></script>
@endsection