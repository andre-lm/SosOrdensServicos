@extends('template.app')

@section('title')
Criar chamado
@endsection

@section('content')

<div class="card " style="margin: 0 6em; padding:10px">
    @if(isset($errors) && count($errors)>0)
        <div class="alert text-center mt-1 mb-1 p-2 alert-danger alert-error">
          @foreach($errors->all() as $erro)
              {{$erro}}<br>
          @endforeach
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif

    <div class="text-center">
        <span class="float-center">
           <h4>Criar chamado</h4>
        </span>
    </div>
    <form action="{{ route('os.store') }}" method="POST">

      @csrf
        <div class="row">
          <div class="form-group mt-1 mb-2 col-6">
            <input type="text" class="form-control" placeholder="Autor" aria-label="Autor" name = "nome_autor">
          </div>

          <div class="form-group mt-1 mb-2 col-6">
            <select class="form-select" name = "atribuido_tecnico" aria-label="Técnico atribuído" >
              <option selected>Escolha o técnico</option>
              @foreach(findTecnicos() as $id => $nome)
                <option value="{{$id}}">{{$nome}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group mt-1 mb-2">
          <input type="text" class="form-control" placeholder="Nome do Equipamento" aria-label="Nome do Equipamento" name = "equipamento">
        </div>
     
        <div class="form-group mt-1 mb-2">
          <input type="text" class="form-control" placeholder="Titulo" aria-label="Titulo" name = "titulo">
        </div>
        
        <div class="form-group mt-1 mb-2 form-floating">
            <textarea class="form-control" placeholder="Descrição"  name = "descrição" style="height: 100px"></textarea>
            <label for="floatingTextarea2">Descrição</label>
        </div>
        <br>
          <div class = "col">
           <button type ='submit' class = "btn btn-primary">Salvar</button>
           <a href="{{route('os.index')}}" class="btn btn-light border">Cancelar</a>
          </div>
    </form>
</div>
@endsection

