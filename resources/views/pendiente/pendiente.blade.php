@extends('plantilla')

@section('contenidoPrincipal')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-clipboard-list"></i> Lista de pendientes</span>
                        <a href="{{ route('crearPendiente') }}" class="btn btn-warning btn-sm"><i class="bi bi-plus-circle"></i> Nuevo</a>
                    </div>
                    <div class="card-body">
                        <div style="display: none">{{ $cont = 0 }}</div>
                        @if (count($pendientes) > 0)
                            <table class="table table-striped table-bordered" id="tblPendiente">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre Pendiente</th>
                                        <th scope="col">Detalle Pendiente</th>
                                        <th scope="col">Estado Pendiente</th>
                                        <th scope="col">Usuario Edición</th>
                                        <th scope="col">Fecha creación</th>
                                        <th scope="col">Fecha actualización</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendientes as $pendiente)
                                        <tr>
                                            <th scope="row">{{ ++$cont }}</th>
                                            <td>{{ $pendiente->nombrePendiente }}</td>
                                            <td>{{ $pendiente->detallePendiente }}</td>
                                            @if($pendiente->estadoPendiente =='no_iniciado') 
                                            <td>NO INICIADO</td>
                                            @elseif($pendiente->estadoPendiente =='en_curso') 
                                            <td>EN CURSO</td>
                                            @elseif($pendiente->estadoPendiente =='en_espera') 
                                            <td>EN ESPERA</td>
                                            @elseif($pendiente->estadoPendiente =='finalizado')
                                            <td>FINALIZADO</td> 
                                            @endif
                                            <td>{{ $pendiente->idUsuario->nombreUsuario }} {{ $pendiente->idUsuario->apellidoUsuario }}</td>
                                            <td>{{ $pendiente->created_at }}</td>
                                            <td>{{ $pendiente->updated_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('editarPendiente', $pendiente->idPendiente) }}"
                                                        class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                    <a class="btn btn-danger borrarPendiente" style="cursor: pointer;">
                                                        <p class="idPendiente" hidden>{{ $pendiente->idPendiente }}</p>
                                                        <p class="nombrePendiente" hidden>{{ $pendiente->nombrePendiente }}</p>
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if (count($pendientes) == 0)
                            <h5>
                                <center>No existen pendientes registrados</center>
                            </h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pendiente/lstPendiente.js') }}"></script>
@endsection
