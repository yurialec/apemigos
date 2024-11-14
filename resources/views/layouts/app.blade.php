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
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body class="index-page">
    @yield(section: 'content')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Criação do HTML do widget com formulário inicial
            const widgetHTML = `
        <div id="chat-widget" style="position: fixed; bottom: 20px; right: 20px; width: 300px; height: 400px; box-shadow: 0 4px 8px rgba(0,0,0,0.2); display: none; flex-direction: column; border-radius: 8px; background-color: #f1f1f1; font-family: Arial, sans-serif;">
            <div id="chat-header" style="background-color: #007bff; color: white; padding: 10px; display: flex; justify-content: space-between; align-items: center; border-radius: 8px 8px 0 0;">
                <span>Helpdesk Chat</span>
                <button id="close-chat" style="background: none; border: none; color: white; font-size: 16px; cursor: pointer;">✖</button>
            </div>
            <div id="user-info-form" style="flex: 1; padding: 10px; overflow-y: auto;">
                <p>Por favor, preencha as informações para iniciar o atendimento:</p>
                <input type="text" id="user-cpf-cnpj" placeholder="CPF/CNPJ" style="width: 100%; margin-bottom: 8px;">
                <input type="email" id="user-email" placeholder="Email" style="width: 100%; margin-bottom: 8px;">
                <input type="text" id="user-phone" placeholder="Telefone" style="width: 100%; margin-bottom: 8px;">
                <input type="text" id="user-name" placeholder="Nome do Responsável" style="width: 100%; margin-bottom: 8px;">
                <button id="start-chat" style="width: 100%; padding: 8px; background-color: #007bff; color: white; border: none; cursor: pointer;">Iniciar Atendimento</button>
            </div>
            <div id="chat-content" style="display: none; flex: 1; padding: 10px; overflow-y: auto;">
                <div id="chat-messages" style="height: 100%; display: flex; flex-direction: column;"></div>
            </div>
            <div id="chat-input-container" style="display: none; border-top: 1px solid #ddd;">
                <input type="text" id="chat-input" placeholder="Digite sua mensagem" style="flex: 1; padding: 8px; border: none; outline: none; border-radius: 0 0 0 8px;">
                <button id="send-button" style="padding: 8px 10px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 0 0 8px 0;">Enviar</button>
            </div>
        </div>
        <button id="chat-toggle" style="position: fixed; bottom: 20px; right: 20px; background-color: #007bff; color: white; border: none; border-radius: 50%; width: 50px; height: 50px; font-size: 18px; cursor: pointer; display: flex; align-items: center; justify-content: center;">💬</button>`;
            $('body').append(widgetHTML);

            // Função para abrir o widget e esconder o botão de ícone de chat
            $('#chat-toggle').on('click', function() {
                $('#chat-widget').fadeIn();
                $(this).hide();
            });

            // Função para fechar o widget e mostrar o botão de ícone de chat
            $('#close-chat').on('click', function() {
                $('#chat-widget').fadeOut();
                $('#chat-toggle').show();
            });

            // Função para iniciar o atendimento após preencher as informações
            $('#start-chat').on('click', function() {
                const userCpfCnpj = $('#user-cpf-cnpj').val().trim();
                const userEmail = $('#user-email').val().trim();
                const userPhone = $('#user-phone').val().trim();
                const userName = $('#user-name').val().trim();

                if (userCpfCnpj && userEmail && userPhone && userName) {
                    // Enviar os dados do usuário para o servidor
                    $.ajax({
                        url: 'http://localhost:8080/api/helpdesk/chat',
                        method: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            cpf_cnpj: userCpfCnpj,
                            email: userEmail,
                            telefone: userPhone,
                            responsavel: userName
                        }),
                        success: function(data) {
                            // Exibir a interface de chat e esconder o formulário
                            $('#user-info-form').hide();
                            $('#chat-content').show();
                            $('#chat-input-container').show();

                            // Exibir uma mensagem de boas-vindas
                            displayMessage("Atendimento iniciado. Como posso ajudar?",
                                'server');
                        },
                        error: function(error) {
                            console.error('Erro ao enviar informações do usuário:', error);
                        }
                    });
                } else {
                    alert("Por favor, preencha todos os campos.");
                }
            });

            // Função para enviar mensagem para o servidor do helpdesk
            const sendMessage = (message) => {
                $.ajax({
                    url: 'http://localhost:8080/api/helpdesk/chat',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        message: message
                    }),
                    success: function(data) {
                        displayMessage(data.response, 'server');
                    },
                    error: function(error) {
                        console.error('Erro ao enviar a mensagem:', error);
                    }
                });
            };

            // Função para exibir mensagens na área de chat
            const displayMessage = (message, sender) => {
                const messageElement = $('<div>').text(message).css({
                    margin: '5px',
                    padding: '8px',
                    borderRadius: '8px',
                    maxWidth: '80%',
                    alignSelf: sender === 'user' ? 'flex-end' : 'flex-start',
                    backgroundColor: sender === 'user' ? '#007bff' : '#ddd',
                    color: sender === 'user' ? 'white' : 'black'
                });
                $('#chat-messages').append(messageElement);
                $('#chat-content').scrollTop($('#chat-content')[0].scrollHeight);
            };

            // Envio de mensagem pelo botão "Enviar"
            $('#send-button').on('click', function() {
                const message = $('#chat-input').val().trim();
                if (message) {
                    displayMessage(message, 'user');
                    sendMessage(message);
                    $('#chat-input').val('');
                }
            });

            // Envio de mensagem ao pressionar Enter
            $('#chat-input').on('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    $('#send-button').click();
                }
            });
        });
    </script>
</body>

</html>
