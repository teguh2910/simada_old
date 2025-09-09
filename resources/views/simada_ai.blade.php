@extends('layouts.app')

@section('content')
<div class="container">
    <h2>SIMADA AI Chat</h2>
    <div id="simada-ai-chatbox" style="max-width:500px;margin:auto;">
        <div id="chat-messages" style="height:400px;overflow-y:auto;border:1px solid #ccc;padding:10px;background:#f9f9f9;"></div>
        <div class="input-group mt-3">
            <input type="text" id="chat-input" class="form-control" placeholder="Type your message...">
            <button id="send-btn" class="btn btn-success">Send</button>
        </div>
    </div>
</div>
@endsection



@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    async function sendMessage() {
        const input = document.getElementById('chat-input');
        const message = input.value.trim();
        if (!message) return;
        appendMessage('You', message);
        input.value = '';
        // Call n8n webhook
        const res = await fetch('https://n8n.servercikarang.cloud/webhook/cat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message })
        });
        let data = {};
        try {
            data = await res.json();
        } catch (e) {
            data.output = 'No response';
        }
        appendMessage('SIMADA AI', (data.output || 'No response').replace(/\n/g, '<br>'));
    }

    document.getElementById('send-btn').onclick = sendMessage;
    document.getElementById('chat-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    function appendMessage(sender, text) {
        const chat = document.getElementById('chat-messages');
        const msg = document.createElement('div');
        msg.innerHTML = `<strong>${sender}:</strong> ${text}`;
        chat.appendChild(msg);
        chat.scrollTop = chat.scrollHeight;
    }
});
</script>
@show
