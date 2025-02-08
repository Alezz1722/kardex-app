<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" type="text/css" media="all" />
    <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    @yield('csss')

    <title>Lab Center</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <!--<img src="/img/logo.png" width="25px" height="25px" />-->
                <span><i class="bi bi-cash-coin"></i> LAB Center</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @if (session('usuarioConectado'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pendiente') }}"><i class="bi bi-clock-history"></i>
                                Pendientes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('movimiento') }}"><i class="bi bi-arrow-down-up"></i>
                                Movimientos</a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kardex') }}"><i class="bi bi-activity"></i>
                                Ingresos Egresos</a>
                        </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    @if (!session('usuarioConectado'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i
                                    class="bi bi-box-arrow-in-right"></i> Iniciar Sesión</a>
                        </li>
                    @endif

                    @if (session('usuarioConectado'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-person-badge-fill"></i>
                                {{ session('usuarioConectado')['nombreUsuario'] }}
                                {{ session('usuarioConectado')['apellidoUsuario'] }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('usuario') }}"><i class="bi bi-pencil-square"></i> Editar mi
                                    perfil</a>
                                <a class="dropdown-item" href="{{ route('passwordUsuario') }}"><i class="bi bi-key"></i> Cambiar contraseña</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target="#cerrarSesionModal"
                                    href="#"><i class="bi bi-box-arrow-left"></i> Cerrar Sesión</a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="loading" hidden>Loading&#8230;</div>
    <div class="container-fluid">
        @yield('contenidoPrincipal')
    </div>
    <!-- Modal cerrar sesion -->
    <div class="modal fade" id="cerrarSesionModal" tabindex="-1" role="dialog"
        aria-labelledby="cerrarSesionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <center>¿ Esta seguro de cerrar su sesión ?</center>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi bi-x-circle"></i> Cancelar</button>
                    <a role="button" class="btn btn-danger" href="{{ route('cerrarSesion') }}"><i class="bi bi-box-arrow-left"></i> Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/4f83231313.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/es.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    @yield('scripts')
</body>

</html>
