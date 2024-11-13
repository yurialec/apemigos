<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Apemigos</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/site.scss', 'resources/js/app.js'])

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body class="index-page">
    @yield(section: 'content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <script>
        (function () {
            // Criação do HTML do widget
            const widgetHTML = `
        <div id="chat-widget" style="position: fixed; bottom: 20px; right: 20px; width: 300px; height: 400px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); display: none; flex-direction: column; border-radius: 8px; background-color: #f1f1f1; font-family: Arial, sans-serif;">
            <div id="chat-header" style="background-color: #007bff; color: white; padding: 10px; display: flex; justify-content: space-between; align-items: center; border-radius: 8px 8px 0 0;">
                <span>Helpdesk Chat</span>
                <button id="close-chat" style="background: none; border: none; color: white; font-size: 16px; cursor: pointer;">✖</button>
            </div>
            <div id="chat-content" style="flex: 1; padding: 10px; overflow-y: auto;">
                <div id="chat-messages" style="height: 100%; display: flex; flex-direction: column;"></div>
            </div>
            <div style="display: flex; border-top: 1px solid #ddd;">
                <input type="text" id="chat-input" placeholder="Digite sua mensagem" style="flex: 1; padding: 8px; border: none; outline: none; border-radius: 0 0 0 8px;">
                <button id="send-button" style="padding: 8px 10px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 0 0 8px 0;">Enviar</button>
            </div>
        </div>
        <button id="chat-toggle" style="position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; border: none; border-radius: 50%; width: 50px; height: 50px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;">💬</button>`;
            document.body.insertAdjacentHTML('beforeend', widgetHTML);

            // Elementos do widget
            const chatWidget = document.getElementById('chat-widget');
            const chatToggle = document.getElementById('chat-toggle');
            const closeChat = document.getElementById('close-chat');

            // Função para abrir o widget e esconder o botão de ícone de chat
            chatToggle.onclick = () => {
                chatWidget.style.display = 'flex';
                chatToggle.style.display = 'none';
            };

            // Função para fechar o widget e mostrar o botão de ícone de chat
            closeChat.onclick = () => {
                chatWidget.style.display = 'none';
                chatToggle.style.display = 'flex';
            };

            // Função para enviar mensagem para o servidor do helpdesk
            const sendMessage = (message) => {
                fetch('https://api.helpdesk.com/send-message', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_id: "user123", message: message })
                })
                    .then(response => response.json())
                    .then(data => {
                        displayMessage(data.response, 'server');
                    })
                    .catch(error => {
                        console.error('Erro ao enviar a mensagem:', error);
                    });
            };

            // Função para exibir mensagens na área de chat
            const displayMessage = (message, sender) => {
                const messageElement = document.createElement('div');
                messageElement.textContent = message;
                messageElement.style.margin = '5px';
                messageElement.style.padding = '8px';
                messageElement.style.borderRadius = '8px';
                messageElement.style.maxWidth = '80%';
                messageElement.style.alignSelf = sender === 'user' ? 'flex-end' : 'flex-start';
                messageElement.style.backgroundColor = sender === 'user' ? '#007bff' : '#ddd';
                messageElement.style.color = sender === 'user' ? 'white' : 'black';
                document.getElementById('chat-messages').appendChild(messageElement);
                document.getElementById('chat-content').scrollTop = document.getElementById('chat-content').scrollHeight;
            };

            // Envio de mensagem pelo botão "Enviar"
            document.getElementById('send-button').onclick = () => {
                const chatInput = document.getElementById('chat-input');
                const message = chatInput.value.trim();
                if (message) {
                    displayMessage(message, 'user');
                    sendMessage(message);
                    chatInput.value = '';
                }
            };

            // Envio de mensagem ao pressionar Enter
            document.getElementById('chat-input').addEventListener('keypress', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    document.getElementById('send-button').click();
                }
            });
        })();

    </script>
</body>

</html>