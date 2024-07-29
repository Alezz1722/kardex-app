@extends('plantilla')


@section('contenidoPrincipal')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="idMovimiento" style="display: none">{{ $movimiento->idMovimiento }}</div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <i class="bi bi-pencil-square"></i> Editar Movimiento</span>
                        <a href="{{ route('movimiento') }}" class="btn btn-warning btn-sm"><i class="bi bi-card-checklist"></i> Regresar a lista de movimientos</a>
                    </div>
                    <div class="card-body">
                        @if (session('mensaje'))
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif
                        <form id="formEditaMovimiento" method="POST">
                            @csrf
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                <i class="fas fa-exclamation-triangle"></i> Por favor corrige los siguientes errores :
                                <ul class="listaErrores">
                                </ul>
                            </div>
                            <div class="form-group row">
                                <label for="nombreMovimiento" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <div class="nombreMovimiento" hidden>{{ $movimiento->nombreMovimiento }}</div>
                                    <input type="text" class="form-control" id="nombreMovimiento" name="nombreMovimiento"
                                        placeholder="Ingrese el nombre del movimiento" value="{{ $movimiento->nombreMovimiento }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detalleMovimiento" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                        <textarea class="form-control" id="detalleMovimiento" name="detalleMovimiento" rows="3" placeholder="Ingrese el detalle del movimiento" >{{ $movimiento->detalleMovimiento }}</textarea>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-block" type="submit"><i class="bi bi-pencil-fill"></i> Editar
                                lugar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/movimiento/movimientoUpdatejs.js') }}"></script>
@endsection
