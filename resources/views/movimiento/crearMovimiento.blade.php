@extends('plantilla')

@section('contenidoPrincipal')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-plus-square-fill"></i> Agregar Movimiento</span>
                        <a href="{{ route('movimiento') }}" class="btn btn-warning btn-sm"><i class="bi bi-card-checklist"></i> Regresar a lista de movimientos</a>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            <i class="fas fa-exclamation-triangle"></i> Por favor corrige los siguientes errores :
                            <ul class="listaErrores">
                            </ul>
                        </div>
                        <form id="formMovimiento" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="nombreMovimiento" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombreMovimiento" name="nombreMovimiento"
                                        placeholder="Ingrese el nombre del movimiento" value="{{ old('nombreMovimiento') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detalleMovimiento" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="detalleMovimiento" name="detalleMovimiento" rows="3" placeholder="Ingrese el detalle del movimiento" value="{{ old('detalleMovimiento') }}"></textarea>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-block" type="submit" id="submitFormMovimiento"><i class="bi bi-plus"></i> Agregar movimiento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/movimiento/movimientojs.js') }}"></script>
@endsection
