<!-- Botón flotante del chatbot -->
<button id="chatbot-toggle" class="btn btn-success rounded-circle shadow" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; width: 60px; height: 60px;">
    <i class="fas fa-comments fa-lg"></i>
</button>

<!-- Contenedor del chatbot -->
<div id="chatbot-container" class="card d-none shadow-lg" style="position: fixed; bottom: 90px; right: 20px; width: 360px; z-index: 9999;">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <span><i class="fas fa-robot mr-2"></i>Asistente Virtual</span>
        <button id="chatbot-close" class="btn btn-tool text-white"><i class="fas fa-times"></i></button>
    </div>
    <div class="card-body" style="height: 300px; overflow-y: auto;" id="chatbot-messages">
        <div class="text-muted text-center">Hola 👋 ¿En qué puedo ayudarte hoy?</div>
    </div>
    <div class="card-footer p-2">
        <div class="input-group">
            <input type="text" id="user-message" class="form-control" placeholder="Escribe tu mensaje...">
            <div class="input-group-append">
                <button id="send-message" class="btn btn-success"><i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script src="{{ asset('js/chatbot.js') }}"></script>
@endpush

<style>
    #chatbot-container {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    }

    #chatbot-container.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>
