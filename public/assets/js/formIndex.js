//Formulário
$(document).ready(function() {
    // Função para validar email
    function validarEmail(email) {
        // Regex robusto para validação de email
        const regex = /^[a-zA-Z0-9]([a-zA-Z0-9._-]*[a-zA-Z0-9])?@[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?(\.[a-zA-Z0-9]([a-zA-Z0-9-]*[a-zA-Z0-9])?)*\.[a-zA-Z]{2,}$/;
        
        // Verifica se o email corresponde ao padrão
        if (!regex.test(email)) {
            return false;
        }
        
        // Validações adicionais
        const partes = email.split('@');
        if (partes.length !== 2) return false;
        
        const [local, dominio] = partes;
        
        // Verifica se a parte local não está vazia e tem comprimento válido
        if (!local || local.length > 64) return false;
        
        // Verifica se o domínio tem pelo menos um ponto
        if (!dominio || !dominio.includes('.')) return false;
        
        // Verifica se o domínio não começa ou termina com ponto ou hífen
        if (dominio.startsWith('.') || dominio.endsWith('.') || 
            dominio.startsWith('-') || dominio.endsWith('-')) return false;
        
        // Verifica se não há pontos consecutivos
        if (email.includes('..')) return false;
        
        return true;
    }

    // Função para mostrar modal de erro
    function mostrarErroEmail() {
        $('#modal-title').text('Email Inválido!');
        $('#modal-message').text('Por favor, insira um endereço de email válido. Exemplo: seunome@dominio.com');
        $('#result-modal').removeClass('border-green-500').addClass('border-red-500 border-t-4');
        $('#modal-title').removeClass('text-green-600').addClass('text-red-600');
        $('#modal-overlay').removeClass('hidden');
    }

    // Intercepta a submissão do formulário
    $('#contact-form').on('submit', function(event) {
        event.preventDefault();

        // Pega o valor do email
        const email = $('#email').val().trim();
        
        // Valida o email antes de enviar
        if (!validarEmail(email)) {
            mostrarErroEmail();
            return false;
        }

        let formData = $(this).serialize();
        $('.btn-primary').prop('disabled', true).text('Enviando...');

        $.ajax({
            // Usamos a ROTA definida no seu ctrlRotas.php
            url: 'enviar-contato', 
            type: 'POST',
            data: formData,
            dataType: 'json', 
            success: function(response) {
                $('#modal-title').text(response.status === 'success' ? 'Sucesso!' : 'Erro!');
                $('#modal-message').text(response.message);

                if (response.status === 'success') {
                    $('#result-modal').removeClass('border-red-500').addClass('border-green-500 border-t-4');
                    $('#modal-title').removeClass('text-red-600').addClass('text-green-600');
                    $('#contact-form')[0].reset();
                } else {
                    $('#result-modal').removeClass('border-green-500').addClass('border-red-500 border-t-4');
                    $('#modal-title').removeClass('text-green-600').addClass('text-red-600');
                }
                $('#modal-overlay').removeClass('hidden');
            },
            error: function(xhr, status, error) {
                $('#modal-title').text('Erro de Conexão!');
                $('#modal-message').text('Não foi possível se comunicar com o servidor. Por favor, tente novamente.');
                $('#result-modal').addClass('border-red-500 border-t-4');
                $('#modal-title').addClass('text-red-600');
                $('#modal-overlay').removeClass('hidden');
            },
            complete: function() {
                $('.btn-primary').prop('disabled', false).text('Enviar Solicitação');
            }
        });
    });

    // Evento para fechar o modal
    $('#close-form-modal').on('click', function() {
        $('#modal-overlay').addClass('hidden');
    });
});
