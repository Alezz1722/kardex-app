@extends('plantilla')


@section('contenidoPrincipal')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="idPendiente" style="display: none">{{ $pendiente->idPendiente }}</div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <i class="bi bi-pencil-square"></i> Editar Pendiente</span>
                        <a href="{{ route('pendiente') }}" class="btn btn-warning btn-sm"><i class="bi bi-card-checklist"></i> Regresar a lista de pendientes</a>
                    </div>
                    <div class="card-body">
                        @if (session('mensaje'))
                            <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif
                        <form id="formEditaPendiente" method="POST">
                            @csrf
                            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                <i class="fas fa-exclamation-triangle"></i> Por favor corrige los siguientes errores :
                                <ul class="listaErrores">
                                </ul>
                            </div>
                            <div class="form-group row">
                                <label for="nombrePendiente" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <div class="nombrePendiente" hidden>{{ $pendiente->nombrePendiente }}</div>
                                    <input type="text" class="form-control" id="nombrePendiente" name="nombrePendiente"
                                        placeholder="Ingrese el nombre del pendiente" value="{{ $pendiente->nombrePendiente }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detallePendiente" class="col-sm-2 col-form-label">Detalle</label>
                                <div class="col-sm-10">
                                        <textarea class="form-control" id="detallePendiente" name="detallePendiente" rows="3" placeholder="Ingrese el detalle del pendiente" >{{ $pendiente->detallePendiente }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="estadoPendiente" class="col-sm-2 col-form-label">Estado</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="estadoPendiente">
                                        <option value="">Seleccione el estado</option>
                                        <option value="no_iniciado" {{ "no_iniciado" == $pendiente->estadoPendiente ? 'selected' : '' }}>NO INICIADO</option>
                                        <option value="en_curso" {{ "en_curso" == $pendiente->estadoPendiente ? 'selected' : '' }}>EN CURSO</option>
                                        <option value="en_espera" {{ "en_espera" == $pendiente->estadoPendiente ? 'selected' : '' }}>EN ESPERA</option>
                                        <option value="finalizado" {{ "finalizado" == $pendiente->estadoPendiente ? 'selected' : '' }}>FINALIZADO</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-warning btn-block" type="submit"><i class="bi bi-pencil-fill"></i> Editar
                                pendiente</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/pendiente/pendienteUpdatejs.js') }}"></script>
@endsection
