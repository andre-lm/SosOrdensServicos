<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ordens de Serviços - @yield('title')</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <link rel="stylesheet" href="{{ asset('css/template-style.css') }}">

        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('os.index')}}">SOS Ordem de Serviço</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>

            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" role="button" >
                            <i class="fas fa-user fa-fw"></i> {{ __('Login') }}
                        </a>
                        {{-- <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> --}}
                    </li>
                    
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                    </div>
                </li>
                
                @endguest
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="text-center mt-2 mb-4">
                        <div class="my-profile">
                            <i class="fas fa-user-circle fa-5x"></i>
                        </div>
                        @guest
                        <b>Login</b>
                        @else
                        <b>{{ Auth::user()->name }}</b> <br>
                        <small>{{ Auth::user()->email }}</small>
                        @endguest
                    </div>
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            <a class="nav-link" href="{{route('os.index')}}">
                                <div class="sb-nav-link-icon"></div>
                                Visualizar OS's
                            </a>

                            {{-- <div class="sb-sidenav-menu-heading">Gerenciar OS</div> --}}
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOS" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                                Ordens de Serviço
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseOS" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('os.create') }}">Criar Chamado</a>
                                    <a class="nav-link" href="{{route('emAberto')}}">Em Aberto</a>
                                    <a class="nav-link" href="{{route('emAtendimento')}}">Em Atendimento</a>
                                    <a class="nav-link" href="{{route('encerrados')}}">Encerrados</a>
                                </nav>
                            </div>

                            @guest
                                  {{-- se nao estiver logado nao aparecer nada --}}
                            @else
                            {{-- <div class="sb-sidenav-menu-heading">Gerenciar Perfil</div> --}}
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePerfil" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Perfil
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapsePerfil" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    
                                    <a class="nav-link" href="{{ route('user.show',Auth::user()->id) }}" >
                                        Meu Perfil
                                    </a>
                                    
                                    @if(userIsAdmin(Auth::user()))
                                        <a class="nav-link" href="{{ route('user.index')}}">{{ __('Listar Usuarios') }}</a>
                                    @endif

                                    @if(userIsTecnico(Auth::user()))
                                        <a class="nav-link" href="{{ route('user.meusChamados', Auth::user()->id)}}" >
                                            Meus chamados 
                                            @if(countOs(Auth::user()) > 0)
                                            <span class="badge badge-success"> {{countOs(Auth::user())}}</span>
                                            @endif
                                        </a>
                                    @endif

                                    <a class="nav-link" href="{{ route('user.create')}}" >
                                        Cadastrar
                                    </a>

                                </nav>
                            </div>
                            @endguest
                                    
                        </div>
                    </div>

                        <div class="sb-sidenav-footer">
                            @guest
                            <div class="small">Você não está logado</div>
                            @else
                                <div class="small">Logado como:</div>
                                {{ Auth::user()->name }}
                            @endguest
                        </div>
                </nav>
            </div>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h2 class="mt-4">@yield('title')</h2>
                       
                        @yield('breadcrumb')
                        
                        
                        @include('flash-message')
                        @yield('content')                        
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 
                                <strong>Dev André Mesquita.</strong> 
                                SOS Ordens Serviços {{date('Y')}}</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="{{ asset('js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" ></script>

        <script src="{{ asset('js/script.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="{{ asset('plugins/jquery-confirm-v3.3.4/css/jquery-confirm.css')}}">
        <script src="{{ asset('plugins/jquery-confirm-v3.3.4/js/jquery-confirm.js')}}"></script>
        <script src="{{ asset('js/javascript.js')}}"></script>

        @yield('scripts')
    </body>
</html>
