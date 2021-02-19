@extends('template.app')

@section('content')

@section('title')
Meu Perfil
@endsection

<div class="card " style="margin: 2em 8em;">
    <div class="text-center">
        <img class="profile-user-img img-fluid img-circle"
            src="{{ asset('img/profile.png') }}"
            alt="{{ $user->name }}">
    </div>

    <div class="text-center">
        <h4>{{$user->name}}</h4>
    </div>
    <div class="card-body p-5 text-center">
        <p class="p-show"><b>Email:</b> {{ $user->email }}</p>
        <p class="p-show"><b>Nível:</b> {{ $user->roleName($user) }}</p>
        @php
        $result = new DateTime($user->created_at);
        $created_at = $result->format("d/m/Y");
        @endphp
        <p class="p-show"><b>Data de criação:</b> {{ $created_at }}</p>
        <a href="{{ route('user.edit', $user->id) }}" class = "btn btn-primary">Editar</a>
    </div>
</div>

@endsection