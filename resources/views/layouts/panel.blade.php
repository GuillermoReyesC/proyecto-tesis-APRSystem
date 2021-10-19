<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Bienvenido</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{URL::asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{URL::asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{URL::asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{URL::asset('plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{URL::asset('css/themes/all-themes.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{URL::asset('css/jquery.dataTables.min.css')}}">

    <script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>
</head>
<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>

    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="/">TIPO DE USUARIO - {{ TipoDeAdmin(Auth::User()->email) }}</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            @if(Alerta(Auth::User()->fecha_facturacion))
                            <span class="label-count">1</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                  @if(Alerta(Auth::User()->fecha_facturacion))
                                    <li>
                                        <a href="/facturacion">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Factura Pentiente</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="/facturacion">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Sin mensajes</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                  @endif

                                </ul>
                            </li>

                        </ul>
                    </li>
                    <!-- #END# Notifications -->

                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::User()->name }}</div>
                    <div class="email">{{ Auth::User()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="/home"><i class="material-icons">person</i>Perfil</a></li>
                            <li><a href="/cerrar-sesion"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">Menu de Navegación</li>
                    <li class="active">
                      @if(Auth::User()->estado == 1)
                        <a href="/home">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                        @if(Auth::User()->admin == 0)
                        <a href="/facturacion">
                            <i class="material-icons">home</i>
                            <span>Facturación</span>
                        </a>
                        @endif
                        @if(Auth::User()->admin == 0)
                        <a href="/consumos">
                            <i class="material-icons">home</i>
                            <span>Consumos</span>
                        </a>
                        @endif
                        @if(Auth::User()->admin == 1)
                        <a href="/usuarios">
                            <i class="material-icons">group_add</i>
                            <span>Usuarios</span>
                        </a>
                        <a href="/reportes">
                            <i class="material-icons">group_add</i>
                            <span>Reportes</span>
                        </a>
                        @endif
                        @else
                        <a href="/cerrar-sesion">
                            <i class="material-icons">group_add</i>
                            <span>Salir</span>
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);"> APRSYSTEM </a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    <section class="content">
        <div class="container-fluid">
          @yield('Panelcontent')
        </div>
    </section>
    <script src="{{URL::asset('plugins/jquery/jquery.min.js')}}"></script>

    <!-- Jquery Core Js -->
    <script type="text/javascript" src="{{URL::asset('js/jquery.dataTables.min.js')}}">
    </script>
    <!-- Jquery Core Js -->
    <!-- Bootstrap Core Js -->
    <script src="{{URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Select Plugin Js -->

    <!-- Slimscroll Plugin Js -->
    <script src="{{URL::asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="{{URL::asset('plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{URL::asset('plugins/node-waves/waves.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{URL::asset('js/admin.js')}}"></script>
    <script src="{{URL::asset('js/pages/ui/modals.js')}}"></script>

    <!-- Demo Js -->
    <script src="{{URL::asset('js/demo.js')}}"></script>
</body>

</html>
