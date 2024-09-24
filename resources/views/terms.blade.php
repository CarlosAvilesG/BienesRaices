@extends('adminlte::page')

@section('title', 'Términos y Condiciones')

@section('content_header')
    <h1>Términos y Condiciones</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Condiciones de Uso para la Empresa de Bienes Raíces en BCS</h3>
        </div>
        <div class="card-body">
            <p>
                Bienvenido a nuestra plataforma de bienes raíces en Baja California Sur, México. Al acceder a nuestro sitio web y utilizar nuestros servicios, aceptas cumplir con los siguientes términos y condiciones. Estos términos están diseñados para asegurar que todos nuestros clientes y visitantes tengan una experiencia justa y segura.
            </p>

            <h4>1. Información General</h4>
            <p>
                La información proporcionada en nuestro sitio web tiene el objetivo de ofrecerte detalles sobre propiedades en venta o renta en Baja California Sur. Nos esforzamos por garantizar la precisión de la información, pero no garantizamos que la misma esté siempre actualizada o libre de errores.
            </p>

            <h4>2. Uso de la Información</h4>
            <p>
                Todos los contenidos de este sitio, incluyendo imágenes, descripciones y datos de propiedades, son propiedad de nuestra empresa. El uso no autorizado de la información, reproducción o distribución sin nuestro consentimiento previo es una violación de nuestras políticas.
            </p>

            <h4>3. Privacidad</h4>
            <p>
                Tu privacidad es importante para nosotros. Cualquier dato personal que proporciones a través de nuestro sitio será tratado con confidencialidad. No compartiremos tus datos con terceros sin tu consentimiento, salvo en los casos previstos por la ley.
            </p>

            <h4>4. Propiedades</h4>
            <p>
                Las propiedades listadas en nuestra plataforma pueden cambiar sin previo aviso. Los precios y la disponibilidad de las propiedades están sujetos a modificaciones según las condiciones del mercado y las decisiones del propietario.
            </p>

            <h4>5. Responsabilidad Limitada</h4>
            <p>
                No nos hacemos responsables de daños directos o indirectos que puedan derivarse del uso de nuestro sitio o de la información contenida en él. Siempre recomendamos realizar una inspección detallada de las propiedades y obtener asesoramiento legal antes de cualquier transacción.
            </p>

            <h4>6. Jurisdicción</h4>
            <p>
                Estos términos y condiciones se rigen por las leyes de Baja California Sur, México. Cualquier disputa relacionada con estos términos será resuelta en los tribunales de BCS.
            </p>

            <p class="mt-3">
                Si tienes alguna duda o consulta sobre estos términos, no dudes en ponerte en contacto con nosotros a través de nuestros canales de atención al cliente.
            </p>
        </div>
    </div>
@stop

@section('css')
    {{-- Aquí puedes añadir hojas de estilo adicionales --}}
    <style>
        .card-title {
            font-weight: bold;
        }
        p {
            text-align: justify;
        }
    </style>
@stop

@section('js')
    <script> console.log("Página de Términos y Condiciones cargada correctamente."); </script>
@stop
