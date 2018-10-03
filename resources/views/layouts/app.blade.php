<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <!-- JAVASCRIPT - JQUERY -AJAX -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script> -->
    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script> -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>


    <!-- JSTREE -->
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/themes/default/style.min.css" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/style.min.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('dist/themes/default/style.min.css') }}" />

    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.5/jstree.min.js"></script> -->
    <!-- <script src="{{ asset('/js/jstree.min.js') }}"></script> -->
    <script src="{{ asset('dist/jstree.min.js') }}"></script>


    <!-- SCRIPTS CREADOS POR MI -->    
    <script src="{{ asset('/js/user.js') }}"></script>
    <script src="{{ asset('/js/tree.js') }}"></script> 
    <script src="{{ asset('/js/dominio.js') }}"></script> 
    <script src="{{ asset('/js/proceso.js') }}"></script>  
    <script src="{{ asset('/js/subproceso.js') }}"></script>
    <script src="{{ asset('/js/riesgo.js') }}"></script>
    <script src="{{ asset('/js/control.js') }}"></script>
    <script src="{{ asset('/js/actividad.js') }}"></script>

    <!-- TITULO -->
    <title>SANTANDER</title>


    <!-- SCRIPTS -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> Causa interferencia -->
    <!-- FONTS -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- STYLES -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 



</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                
                <a class"a-logo_Santander" href="{{ url('/home') }}"><img class="logo_san" src="/svg/logo_Santander3.png"  alt="X"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <ul class="nav">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                            </li>

                            <!-- **********************    MENÚ     *********************** -->

                            <!-- SUPERUSARIO / SUBDIRECTOR-->
                            @if (Auth::user()->per_id == 1 || Auth::user()->per_id == 2)
                                <li><a href="{{ route('tree') }}">RISKS´ TREE</a></li>                                
                                <li><a href="">Usuarios</a>
                                    <ul>
                                        <li><a href="{{ route('register') }}">Alta</a></li>
                                        <li><a href="{{ route('us_viewModificar') }}">Modificar</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Dominios</a>
                                    <ul
                                        <li><a href="{{ route('dom_viewAlta') }}">Alta</a></li>
                                        <li><a href="{{ route('dom_viewModificar') }}">Modificar</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Procesos</a>
                                    <ul>
                                        <li><a href="{{ route('proc_viewAlta') }}">Alta</a></li>
                                        <li><a href="{{ route('proc_viewModificar') }}">Modificar</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Subprocesos</a>
                                    <ul>
                                        <li><a href="{{ route('subp_viewAlta') }}">Alta</a></li>
                                        <li><a href="{{ route('subp_viewModificar') }}">Modificar</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Riesgos</a>
                                    <ul>
                                        <!-- <li><a href="">Objetivos de Control</a></li>
                                        <li><a href="">Actividades</a></li> -->
                                        <li><a href="{{ route('rgo_viewAlta') }}">Alta</a></li>                                       
                                        <li><a href="{{ route('rgo_viewModificar') }}">Modificar</a></li>
                                    </ul>
                                </li>

                            <!-- CONSULTA-->
                            @elseif (Auth::user()->per_id == 3)
                                <li><a href="{{ route('tree') }}">RISKS´ TREE</a></li>                                
                            @endif
                            
                            <!-- TODOS -->
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Salir') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                        </ul> 
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

   
</body>
</html>
