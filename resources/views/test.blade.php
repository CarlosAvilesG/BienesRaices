@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Prueba de TEST - roles t permisos.</p>

    @if (Auth::user()->hasRole('SuperUsuario'))
    <p>Acceso como administrador</p>
    @else
        <p>Acceso como usuario</p>
    @endif


@stop

@section('css')
     <link rel="stylesheet" href="/css/admin_custom.css">

@stop

@section('js')

@stop

