@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administración.</p>
@stop

@section('css')
    {{-- Estilos personalizados --}}
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('js/datatables.min.css') }}">
    @livewireStyles
@stop

@section('js')
    {{-- Scripts personalizados --}}
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    
    <script> console.log("AdminLTE cargado correctamente!"); </script>
    @livewireScripts
@stop
