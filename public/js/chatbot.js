document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('chatbot-toggle');
    const closeBtn = document.getElementById('chatbot-close');
    const container = document.getElementById('chatbot-container');
    const sendBtn = document.getElementById('send-message');
    const userInput = document.getElementById('user-message');
    const messages = document.getElementById('chatbot-messages');
    const notifySound = new Audio('/sounds/notify.mp3');

    // 🛡️ Prevenir cierre por clic dentro de cualquier parte del chatbot
    container.addEventListener('click', e => e.stopPropagation());
    toggleBtn.addEventListener('click', e => e.stopPropagation());

    // Asignar nombre al invitado
    let guestName = localStorage.getItem('guest_name');
    if (!guestName) {
        guestName = 'Invitado-' + Math.floor(Math.random() * 10000);
        localStorage.setItem('guest_name', guestName);
    }

    // Verificar si el chatbot estaba abierto
    const savedState = localStorage.getItem('chatbot_open');
    if (savedState === 'true') {
        container.classList.remove('d-none');
        setTimeout(() => container.classList.add('show'), 10);
    }

    // Abrir o cerrar el chatbot
    toggleBtn.addEventListener('click', () => {
        console.log('✅ BOTÓN CHAT fue clickeado');

        if (container.classList.contains('d-none')) {
            container.classList.remove('d-none');
            setTimeout(() => container.classList.add('show'), 10);
            localStorage.setItem('chatbot_open', 'true');
        } else {
            container.classList.remove('show');
            setTimeout(() => container.classList.add('d-none'), 300);
            localStorage.setItem('chatbot_open', 'false');
        }
    });

    // Cierre con botón ❌
    closeBtn.addEventListener('click', () => {
        container.classList.remove('show');
        setTimeout(() => container.classList.add('d-none'), 300);
        localStorage.setItem('chatbot_open', 'false');
    });

    // Cierre si haces clic fuera de todo
    document.addEventListener('click', function (e) {
        // Si el clic fue fuera de chatbot y botón
        if (
            !e.target.closest('#chatbot-container') &&
            !e.target.closest('#chatbot-toggle') &&
            !container.classList.contains('d-none')
        ) {
            console.log('❌ Cerrando chatbot por clic fuera:', e.target.id);
            container.classList.remove('show');
            setTimeout(() => container.classList.add('d-none'), 300);
            localStorage.setItem('chatbot_open', 'false');
        }
    });

    // Agrega mensajes al chat
    const appendMessage = (msg, sender) => {
        const div = document.createElement('div');
        const name = sender === 'user' ? guestName : 'Asistente';
        div.className = sender === 'user' ? 'text-right my-1' : 'text-left my-1 text-success';
        div.innerHTML = `<small class="d-block text-muted">${name}</small>
                         <span class="badge badge-${sender === 'user' ? 'primary' : 'secondary'} p-2">${msg}</span>`;
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    };

    // Enviar mensaje
    const sendMessage = () => {
        const msg = userInput.value.trim();
        if (!msg) return;

        appendMessage(msg, 'user');
        userInput.value = '';
        appendMessage('Escribiendo...', 'bot');

        fetch('/chatbot/ask', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: msg })
        })
        .then(res => res.json())
        .then(data => {
            messages.lastChild.remove();
            appendMessage(data.reply, 'bot');
            notifySound.play().catch(e => console.warn("🔇 Audio bloqueado:", e));
        })
        .catch(() => {
            messages.lastChild.remove();
            appendMessage('Error al conectar con el bot.', 'bot');
        });
    };

    sendBtn.addEventListener('click', sendMessage);
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') sendMessage();
    });
});
