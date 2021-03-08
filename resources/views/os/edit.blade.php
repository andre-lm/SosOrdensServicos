@extends('template.app')

@section('title')
Editar chamado
@endsection

@section('breadcrumb')
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item"><a href="{{route('os.show',$os->id)}}">OS</a></li>
  <li class="breadcrumb-item active">Editar chamado {{$os->id}}</li>
</ol>
@endsection

@section('content')
<div class="card " style="padding:10px">
    @if(isset($errors) && count($errors)>0)
        <div class="text-center mt-4 mb-4 p-2 alert-danger alert-error">
          @foreach($errors->all() as $erro)
              {{$erro}}<br>
          @endforeach
        </div>
    @endif
      <form action="{{ route('os.update', $os->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="row">
          <!-- <div class="form-group mt-1 mb-2 col-6">
            <label>Autor</label>
            <input name = "nome_autor" type="text" value = "{{$os->nome_autor}}" class="form-control"> 
          </div> -->
          <div class="form-group mt-1 mb-2 col-12">
            <label>Técnico</label>
            <select name = "atribuido_tecnico" class="form-select" >
              @foreach(findTecnicos() as $id => $nome)
                @php echo '<option value="'.$id.'" '.(($id==$os->users->id)? "selected": "").'>'.$nome.'</option>'; @endphp
              @endforeach
            </select>
          </div>
        </div>
        
        <div class="form-group mt-1 mb-2">
          <label>Equipamento</label>
          <input name = "equipamento" type="text" value = "{{$os->equipamento}}" class="form-control" >
        </div>

        <div class="form-group mt-1 mb-2">
          <label>Titulo</label>
          <input type="text" class="form-control" value = "{{$os->titulo}}" placeholder="Titulo" aria-label="Titulo" name = "titulo">
        </div>
                        
        <div class="form-group mt-1 mb-2">
          <label>Descrição</label>
            <textarea class="form-control" placeholder="Descrição"  name = "descrição" style="height: 100px">{{$os->descrição}} </textarea>
        </div>
        <div class="text-center">
          <button type ='submit' class = "btn btn-primary">Alterar</button>
          <a href="{{route('os.show', $os->id)}}" class="btn btn-light border">Cancelar</a>
        </div>
    </form>
</div>
<div class="text-center">
  <span class="float-center">
  </span>
</div>
@endsection