@extends('template.app')

@section('title')
Listar Usuários
@endsection

@section('breadcrumb')
<ol class="breadcrumb mb-4">
  <li class="breadcrumb-item active">Usuários </li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-body col-12">
        <div class="text-center text-secondary mb-1">
            <a class="btn btn-secondary mb-3" href="{{ route('user.create') }}">Cadastrar</a>
            <br>
            {{'Total de '.$count.' registros - Exibindo '.$users->count().' por página'}}
        </div>

        <table class="table table-hover table-bordered" align = 'center'>
            <thead align = 'center'>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Criação</th>
                    <th>Nível</th>
                    <th colspan ="100%">Ações</th>
                </tr>
            </thead>
            <tfoot align = 'center'>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Criação</th>
                    <th>Nível</th>
                    <th colspan ="100%">Ações</th>
                </tr>
            </tfoot>
            <tbody align = 'center'>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{dateToPTBR($user->created_at)}}</td>
                    <td>{{ $user->roleName($user)}}</td>
                    <td align = ''>
                        <a href="{{route('user.show', $user->id)}}" class="btn btn-light border">Visualizar</a>
                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="os-footer">
        {{$users->links()}}
    </div>
</div>

@endsection