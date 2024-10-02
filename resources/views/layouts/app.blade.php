
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    {{-- <script>
        $(document).ready(function() {
            $('#table2').DataTable({
                'language' => ['url' => '//cdn.datatables.net/plug-ins/2.1.7/i18n/es-MX.json'],
                        'paging' => true,
                        'searching' => true,
                        'info' => true,
                        'autoWidth' => false,
            });
        });
    </script> --}}
@stop
