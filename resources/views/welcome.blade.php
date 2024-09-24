@extends('layouts.guest')

@section('title', 'Bienvenido a Bienes Raíces BCS')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 dark:bg-gray-900">

    <!-- Si el usuario está autenticado, lo redirigimos al dashboard -->
    @if (auth()->check())
        <script>window.location = "{{ route('dashboard') }}";</script>
    @else
        <!-- Logo centrado -->
        <div class="mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bienes Raíces BCS" class="h-24 w-24 mx-auto">
        </div>

        <!-- Título y descripción -->
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Bienvenido a Bienes Raíces BCS</h1>
            <p class="mt-4 text-gray-600 dark:text-gray-400">Por favor, inicia sesión para continuar</p>
        </div>

        <!-- Link de Login -->
        <div class="mt-8">
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">
                Iniciar sesión
            </a>
        </div>
    @endif

</div>
@endsection
