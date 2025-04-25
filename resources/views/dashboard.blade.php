@extends('adminlte::page')

@section('title', 'Panel de Control')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')

    {{-- @dd(auth()->user()->hasRole('SuperUsuario')); --}}
    {{-- Dependiendo del rol, se carga el partial adecuado --}}
    @if(auth()->user()->hasAnyRole(['OperadorCaja', 'GerenteCaja']))
        @include('dashboard.partials.basico')
    @elseif(auth()->user()->hasAnyRole(['AdminGeneral','GerenteCaja']))
        @include('dashboard.partials.completo')
    @elseif(auth()->user()->hasAnyRole(['SuperUsuario', 'Propietario']))
        @include('dashboard.partials.propetario')
    @endif

    @include('vendor.adminlte.components.chatbot-widget')

@stop

@section('css')
     {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script src="{{ asset('js/chatbot.js') }}"></script> --}}
@stop


{{--
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout> --}}
