<!-- resources/views/chat.blade.php -->
<div id="chat">
    <div id="messages"></div>
    <input type="text" id="message" placeholder="Escribe tu mensaje...">
    <button onclick="sendMessage()">Enviar</button>
</div>


<script>

$.get('/chatbot/history', function(messages) {
    messages.forEach(msg => {
        appendMessage(msg.message, msg.sender);
    });
    $messages.scrollTop($messages[0].scrollHeight);
});

function sendMessage() {
    let msg = document.getElementById('message').value;
    fetch('{{ route("chatbot.ask") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ message: msg })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('messages').innerHTML += "<div><b>Tú:</b> " + msg + "</div>";
        document.getElementById('messages').innerHTML += "<div><b>Bot:</b> " + data.reply + "</div>";
        document.getElementById('message').value = '';
    });
}
</script>
