@extends('plantilla')
@section('contenidoPrincipal')
<div class="container-fluid">
@if (!session('usuarioConectado'))
    <br>
    <br>
    Por favor inicie sesión para continuar ..
@endif
@if (session('usuarioConectado'))
    <br>
    <br>
    Bienvenido a la aplicación ..

@endif

</div>
@endsection