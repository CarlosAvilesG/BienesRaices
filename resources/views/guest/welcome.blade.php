<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #ffffff;
        }
        .logo {
            max-width: 300px;
            margin-bottom: 40px;
            text-align: center;
        }
        .login-link {
            text-align: center;
            margin-top: 30px;
            font-size: 18px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .footer-text {
            margin-top: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo de la empresa -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bienes Raíces" style="width: 100%;">
        </div>

        <!-- Link a la página de login -->
        <div class="login-link">
            <a href="{{ route('login') }}">Haz clic aquí para iniciar sesión</a>
        </div>

        <!-- Texto del pie de página -->
        <div class="footer-text">
            © 2023 Bienes Raíces BCS. Todos los derechos reservados.
        </div>
    </div>
</body>
</html>
