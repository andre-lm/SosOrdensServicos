<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ordens de Serviços - @yield('title')</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    </head>
    <body>

    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('os.index')}}">SOS Gerenciamento de Ordem de Serviço</a>
           
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @else
                    
                        <li class="nav-item dropdown" style="display: inline;">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                                <a class="dropdown-item" href="{{ route('user.show',Auth::user()->id) }}" >
                                    Meu Perfil
                                </a>

                                @if(userIsTecnico(Auth::user()))
                                <a class="dropdown-item" href="{{ route('user.meusChamados', Auth::user()->id)}}" >
                                    Meus chamados 
                                    @if(countOs(Auth::user()) > 0)
                                    <span class="badge badge-success">{{countOs(Auth::user())}}</span>
                                    @endif
                                </a>
                                @endif

                                <a class="dropdown-item" href="{{ route('user.create')}}" >
                                    Cadastrar
                                </a>

                                @if(userIsAdmin(Auth::user()))
                                    <a class="dropdown-item" href="{{ route('user.index')}}">{{ __('Gerenciar Usuarios') }}</a>
                                @endif
                            </div>
                        </li>
                       
                    @endguest
                </ul>

            <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" href="{{ route('os.create') }}">Criar Chamado</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('emAberto')}}">Em Aberto</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('emAtendimento')}}">Em Atendimento</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('encerrados')}}">Encerrados</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <main>
            @include('flash-message')

            @yield('content')
    </main>

    <footer class="footer mastfoot mt-auto text-center bg-primary">
        <div class="inner">
            <p><strong>Created by: Dev André Mesquita.</strong> Todos direitos reservados.</p>
        </div>
    </footer>

        <script src="{{ asset('js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm-v3.3.4/css/jquery-confirm.css')}}">
        <script src="{{ asset('plugins/jquery-confirm-v3.3.4/js/jquery-confirm.js')}}"></script>
        <script src="{{ asset('js/javascript.js')}}"></script>

        @yield('scripts')
    </body>
</html>