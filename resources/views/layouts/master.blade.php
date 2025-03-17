<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/icon.png')}}" type="images/x-">
    <title>Bienvenido Agrosoft</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="main-header navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <!-- Botón para abrir menú lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Contenido del Navbar -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <!-- Notificaciones -->
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell"></i>
                            @if(auth()->user()->unreadNotifications->isNotEmpty())
                                <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                            <li class="dropdown-header bg-primary text-white d-flex justify-content-between">
                                <span><i class="fas fa-bell"></i> Notificaciones</span>
                                <a href="{{ route('marcarNotificacionesLeidas') }}" class="text-white small">Marcar todas</a>
                            </li>
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('solicitudes.show', $notification->data['solicitud_id']) }}">
                                        <div class="me-2">
                                            <i class="fas fa-envelope text-primary"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0"><strong>Solicitud #{{ $notification->data['solicitud_id'] }}</strong></p>
                                            <small class="text-muted">{{ $notification->data['mensaje'] }}</small>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="dropdown-item text-center text-muted small">No tienes notificaciones pendientes.</li>
                            @endforelse
                        </ul>
                    </li>
    
                    <!-- Perfil de Usuario -->
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt text-danger"></i> Cerrar Sesión
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <aside class="main-sidebar sidebar-success-green elevation-4">
        <img src="{{ asset('images/LogoAgrosoft2.png')}}" width="80%" alt="">
        <div class="sidebar">
            <!-- Sidebar Menu -->

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <br><br><br><br>

                    <!-- Unidades Productivas -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-success">
                            <i class="fas fa-seedling"></i> &nbsp;
                            <p>
                                Unidades Productivas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('cultivos.create')}}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Ingreso</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('cultivos.index')}}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>Listas</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Bodega Finca -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-success">
                            <i class="fas fa-warehouse"></i>&nbsp;
                            <p>
                                Bodega Finca
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('AdminLTE-3.2.0/pages/UI/general.html') }}"
                                    class="nav-link text-dark">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>Insumos</p>
                                    <i class="fas fa-angle-left right"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('insumos.create') }}" class="nav-link text-dark">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Ingreso</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('insumos.index') }}" class="nav-link text-dark">
                                            <i class="nav-icon fas fa-clipboard-list"></i>
                                            <p>Listas</p>
                                        </a>
                                    </li>
                                </ul>

                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('AdminLTE-3.2.0/pages/UI/icons.html') }}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p>Herramientas</p>
                                    <i class="fas fa-angle-left right"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('herramientas.create') }}" class="nav-link text-dark">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Ingreso</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('herramientas.index') }}" class="nav-link text-dark">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Listas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Roles Mayordomo -->
                    <li class="nav-item">
                        <a href="#" class="nav-link text-success">
                            <i class="fas fa-user"></i>&nbsp;
                            <p>Roles Mayordomo</p>
                            <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('register.mayordomo.form')}}" class="nav-link text-dark">
                                    <i class="fas fa-users"></i>
                                    <p>Mayordomo</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                        <!-- Análisis de Producción -->
                    <li class="nav-item">
                        <a href="{{ asset('AdminLTE-3.2.0/pages/widgets.html') }}" class="nav-link text-success">
                            <i class="nav-icon fas fa-dolly"></i>&nbsp;
                            <p>Recolecta de Cosecha</p>
                            <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('recolectas.create') }}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-folder-open"></i>
                                    <p>Registro de Producción</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('recolectas.graficas') }}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>Analisís de Producción</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('recolectas.rentabilidad')}}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-calculator"></i>
                                    <p>Analisís Rentabilidad</p>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cultivos.index')}}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>Ganancias</p>
                                </a>
                            </li>
                        </ul>

                    </li>

                    <!-- Geo Referencias -->
                    <li class="nav-item">
                        <a href="#" class="nav-link text-success">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Geo Referencias</p>
                            <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('fincas.create') }}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-mountain"></i>
                                    <p>Registro Finca</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('fincas.index') }}" class="nav-link text-dark">
                                    <i class="nav-icon fas fa-map-marker-alt"></i>
                                    <p>Mapa</p>
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                    <!-- Activiadaes -->
                    <li class="nav-item">
                        <a href="#" class="nav-link text-success">
                            <i class="nav-icon fas fa-envelope-open-text"></i>
                            <p>Solicitudes</p>
                            <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('solicitudes.create') }}" class="nav-link text-success"> 
                                <i class="nav-icon fas fa-envelope"></i>
                                    <p>Registro Solicitudes</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('solicitudes.index') }}" class="nav-link text-success">  
                                <i class="nav-icon fas fa-envelope-open-text"></i>
                                    <p>Historial Solicitudes</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <!-- Reportes -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link text-danger">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Reportes<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('AdminLTE-3.2.0/pages/tables/data.html') }}"
                                    class="nav-link text-dark">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
                                    <p>Contable</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- ./wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
</body>

</html>