 //Formulário
    $(document).ready(function() {
        // Intercepta a submissão do formulário
        $('#contact-form').on('submit', function(event) {
            event.preventDefault(); // Previne o envio padrão do formulário

            // Coleta os dados do formulário
            let formData = $(this).serialize();

            // Mostra um indicador de carregamento, se desejar (opcional)
            // Por exemplo, desabilitar o botão de envio
            $('.btn-primary').prop('disabled', true).text('Enviando...');

            // Envia os dados via AJAX
            $.ajax({
                url: 'processar-formulario', // O arquivo PHP que processará
                type: 'POST',
                data: formData,
                dataType: 'json', // Espera uma resposta JSON
                success: function(response) {
                    // Exibe o modal com a mensagem de sucesso ou erro
                    $('#modal-title').text(response.status === 'success' ? 'Sucesso!' : 'Erro!');
                    $('#modal-message').text(response.message);

                    // Adiciona classes Tailwind para estilização baseada no status
                    if (response.status === 'success') {
                        $('#result-modal').removeClass('border-red-500').addClass('border-green-500 border-t-4');
                        $('#modal-title').removeClass('text-red-600').addClass('text-green-600');
                    } else {
                        $('#result-modal').removeClass('border-green-500').addClass('border-red-500 border-t-4');
                        $('#modal-title').removeClass('text-green-600').addClass('text-red-600');
                    }

                    $('#modal-overlay').removeClass('hidden'); // Mostra o overlay e o modal

                    // Se for sucesso, pode limpar o formulário (opcional)
                    if (response.status === 'success') {
                        $('#contact-form')[0].reset();
                    }
                },
                error: function(xhr, status, error) {
                    // Em caso de erro na requisição AJAX (problema de rede, servidor, etc.)
                    $('#modal-title').text('Erro de Conexão!');
                    $('#modal-message').text('Não foi possível se comunicar com o servidor. Por favor, tente novamente.');
                    $('#result-modal').addClass('border-red-500 border-t-4');
                    $('#modal-title').addClass('text-red-600');
                    $('#modal-overlay').removeClass('hidden');
                },
                complete: function() {
                    // Sempre executa, seja sucesso ou erro
                    $('.btn-primary').prop('disabled', false).text('Enviar Solicitação');
                }
            });
        });

        // Evento para fechar o modal
        $('#close-form-modal').on('click', function() {
            $('#modal-overlay').addClass('hidden'); // Esconde o overlay e o modal
        });
    });