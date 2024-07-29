@extends('plantilla')


@section('contenidoPrincipal')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="idKardex" style="display: none">{{ $kardex->idKardex }}</div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-edit"></i> Editar Ingreso/Egreso</span>
                        <a href="{{ route('kardex') }}" class="btn btn-warning btn-sm"><i
                                class="fas fa-arrow-circle-left"></i> Regresar a lista de Ingresos/Egresos</a>
                    </div>
                    <div class="card-body">
                        @if (session('mensaje'))
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif
                        <form id="formEditaKardex" method="POST">
                            @csrf
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                <i class="fas fa-exclamation-triangle"></i> Por favor corrige los siguientes errores :
                                <ul class="listaErrores">
                                </ul>
                            </div>
                            <div class="form-group row">
                                <label for="fechaKardex" class="col-sm-3 col-form-label">Fecha</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="fechaKardex" name="fechaKardex"
                                        placeholder="Ingrese la fecha"
                                        value="{{ $kardex->fechaKardex }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tipoKardex" class="col-sm-3 col-form-label">Tipo</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="tipoKardex">
                                        <option value="">Seleccione el tipo</option>
                                        <option value="INGRESO" {{ "INGRESO" == $kardex->tipoKardex ? 'selected' : '' }}>INGRESO</option>
                                        <option value="EGRESO" {{ "EGRESO" == $kardex->tipoKardex ? 'selected' : '' }}>EGRESO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="idMovimiento" class="col-sm-3 col-form-label">Movimiento</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="idMovimiento">
                                        <option value="">Seleccione el movimiento</option>
                                        @foreach ($movimientos as $key => $value)
                                            <option value="{{ $value->idMovimiento }}" {{ $value->idMovimiento == $kardex->idMovimiento ? 'selected' : '' }}>
                                                {{ $value->nombreMovimiento }} - {{ $value->detalleMovimiento }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detalleKardex" class="col-sm-3 col-form-label">Detalle</label>
                                <div class="col-sm-9">
                                        <textarea class="form-control" id="detalleKardex" name="detalleKardex" rows="3" placeholder="Ingrese el detalle">{{ $kardex->detalleKardex }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="estadoKardex" class="col-sm-3 col-form-label">Estado</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="estadoKardex">
                                        <option value="">Seleccione el estado</option>
                                        <option value="NO_PAGADO" {{ "NO_PAGADO" == $kardex->estadoKardex ? 'selected' : '' }}>NO PAGADO</option>
                                        <option value="EN_PROCESO" {{ "EN_PROCESO" == $kardex->estadoKardex ? 'selected' : '' }}>EN PROCESO</option>
                                        <option value="PAGADO" {{ "PAGADO" == $kardex->estadoKardex ? 'selected' : '' }}>PAGADO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="observacionKardex" class="col-sm-3 col-form-label">Observación</label>
                                <div class="col-sm-9">
                                        <textarea class="form-control" id="observacionKardex" name="observacionKardex" rows="3" placeholder="Ingrese la observación" >{{ $kardex->observacionKardex }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="montoKardex" class="col-sm-3 col-form-label">Monto</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control currency" id="montoKardex" name="montoKardex"
                                        placeholder="Ingrese el monto" min="0.00" max="99999999999.00" step="any" value="{{ $kardex->montoKardex }}">
                                </div>
                            </div>
                            <button class="btn btn-warning btn-block" type="submit"><i class="far fa-edit"></i> Editar Ingreso/Egreso</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/kardex/kardexUpdatejs.js') }}"></script>
@endsection