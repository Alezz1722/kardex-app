@extends('plantilla')

@section('contenidoPrincipal')


    <div class="container" style="padding: 0;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-clipboard-list"></i> Lista de I/E</span>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <!-- <a href="" type="button" class="btn btn-success"><i class="bi bi-filetype-xls"></i> Importar</a> -->
                            <a href="{{ route('crearKardex') }}" type="button" class="btn btn-warning"><i class="bi bi-folder-plus"></i> Registrar</a>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 0.5rem;">
                        <div style="display: none">{{ $cont = 0 }}</div>
                        @if (count($kardexs) > 0)
                            <table class="table table-striped table-bordered table-responsive" id="tblKardex">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" data-field="Fecha" data-filter-control="input">Fecha</th>
                                        <th scope="col" data-field="Detalle" data-filter-control="input">Detalle</th>
                                        <th scope="col" data-field="Tipo" data-filter-control="select">Tipo</th>
                                        <th scope="col" data-field="Estado" data-filter-control="select">Estado</th>
                                        <th scope="col" data-field="Movimiento" data-filter-control="select">Movimiento</th>
                                        <th scope="col" data-field="Usuario_edicion" data-filter-control="select">Usuario</th>
                                        <th scope="col" data-field="Monto" data-filter-control="input">Monto</th>
                                        <!-- <th scope="col" data-field="Fecha_creacion" data-filter-control="input">Fecha creación</th>
                                        <th scope="col" data-field="Fecha_actualizacion" data-filter-control="input">Fecha actualización</th>-->
                                        <th scope="col">Acción</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kardexs as $kardex)
                                        <tr>
                                            <th scope="row">{{ ++$cont }}</th>
                                            <td>{{ $kardex->fechaKardex }}</td>
                                            <td>{{ $kardex->detalleKardex }}</td>
                                            <td>{{ $kardex->tipoKardex }}</td>
                                            <td>{{ str_replace('_', ' ',$kardex->estadoKardex) }}</td>
                                            <td>{{ $kardex->idMovimiento->nombreMovimiento }}</td>
                                            <td>{{ $kardex->idUsuario->nombreUsuario }} {{ $kardex->idUsuario->apellidoUsuario }}</td>
                                            <td>${{ number_format( $kardex->montoKardex , 2, ',', '.') }}</td>
                                            <!--<td>{{ $kardex->created_at }}</td>
                                            <td>{{ $kardex->updated_at }}</td>-->
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('editarKardex', $kardex->idKardex) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                    <a class="btn btn-danger borrarKardex" style="cursor: pointer;">
                                                        <p class="idKardex" hidden>{{ $kardex->idKardex }}
                                                        </p>
                                                        <p class="detalleKardex" hidden>{{ $kardex->detalleKardex }}
                                                        </p>
                                                        <p class="fechaKardex" hidden>{{ $kardex->fechaKardex }}
                                                        </p>
                                                        <p class="montoKardex" hidden>{{ $kardex->montoKardex }}
                                                        </p>
                                                        <p class="tipoKardex" hidden>{{ $kardex->tipoKardex }}
                                                        </p>
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if (count($kardexs) == 0)
                            <h5>
                                <center>No existen Ingresos/Egresos registrados</center>
                            </h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/kardex/lstKardex.js') }}"></script>
@endsection