@extends('plantilla')

@section('contenidoPrincipal')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-plus-square-fill"></i> Agregar Pendiente</span>
                        <a href="{{ route('pendiente') }}" class="btn btn-warning btn-sm"><i class="bi bi-card-checklist"></i> Regresar a lista de pendientes</a>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                            <i class="fas fa-exclamation-triangle"></i> Por favor corrige los siguientes errores :
                            <ul class="listaErrores">
                            </ul>
                        </div>
                        <form id="formPendiente" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="nombrePendiente" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombrePendiente" name="nombrePendiente"
                                        placeholder="Ingrese el nombre del pendiente" value="{{ old('nombrePendiente') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detallePendiente" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="detallePendiente" name="detallePendiente" rows="3" placeholder="Ingrese el detalle del pendiente" value="{{ old('detallePendiente') }}"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="estadoPendiente" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="estadoPendiente">
                                        <option value="">Seleccione el estado del pendiente</option>
                                        <option value="no_iniciado">NO INICIADO</option>
                                        <option value="en_curso">EN CURSO</option>
                                        <option value="en_espera">EN ESPERA</option>
                                        <option value="finalizado">FINALIZADO</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-block" type="submit" id="submitFormPendiente"><i class="bi bi-plus"></i> Agregar pendiente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pendiente/pendientejs.js') }}"></script>
@endsection
