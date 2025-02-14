 {{-- @extends('adminlte::auth.passwords.reset')

@extends('adminlte::auth.auth-page', ['auth_type' => 'password_reset'])

@section('auth_body')
    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ request()->route('token') }}">
        <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="New Password" required>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
    </form>
@stop --}}
@extends('adminlte::auth.auth-page', ['auth_type' => 'password_reset'])

@section('auth_header', 'Restablecer Contraseña')

@section('auth_body')
<div class="d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 80px;">
        </div>

        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <input type="hidden" name="email" value="{{ old('email', request()->email) }}">

            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Nueva Contraseña" required>
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Restablecer Contraseña</button>
        </form>
    </div>
</div>
@stop

