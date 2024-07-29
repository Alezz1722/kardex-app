@extends('plantilla')

@section('contenidoPrincipal')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-clipboard-list"></i> Lista de movimientos para
                            {{ session('usuarioConectado')['nombreUsuario'] }}
                            {{ session('usuarioConectado')['apellidoUsuario'] }} </span>
                        <a href="{{ route('crearMovimiento') }}" class="btn btn-warning btn-sm"><i class="bi bi-plus-circle"></i> Nuevo Movimiento</a>
                    </div>
                    <div class="card-body">
                        <div style="display: none">{{ $cont = 0 }}</div>
                        @if (count($movimientos) > 0)
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre Movimiento</th>
                                        <th scope="col">Detalle Movimiento</th>
                                        <th scope="col">Usuario Edición</th>
                                        <th scope="col">Fecha creación</th>
                                        <th scope="col">Fecha actualización</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($movimientos as $movimiento)
                                        <tr>
                                            <th scope="row">{{ ++$cont }}</th>
                                            <td>{{ $movimiento->nombreMovimiento }}</td>
                                            <td>{{ $movimiento->detalleMovimiento }}</td>
                                            <td>{{ $movimiento->idUsuario->nombreUsuario }} {{ $movimiento->idUsuario->apellidoUsuario }}</td>
                                            <td>{{ $movimiento->created_at }}</td>
                                            <td>{{ $movimiento->updated_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('editarMovimiento', $movimiento->idMovimiento) }}"
                                                        class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                    <a class="btn btn-danger borrarMovimiento" style="cursor: pointer;">
                                                        <p class="idMovimiento" hidden>{{ $movimiento->idMovimiento }}</p>
                                                        <p class="nombreMovimiento" hidden>{{ $movimiento->nombreMovimiento }}</p>
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if (count($movimientos) == 0)
                            <h5>
                                <center>No existen movimientos registrados</center>
                            </h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/movimiento/lstmovimiento.js') }}"></script>
@endsection
