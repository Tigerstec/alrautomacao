//Formulário
$(document).ready(function() {
    // Intercepta a submissão do formulário
    $('#contact-form').on('submit', function(event) {
        event.preventDefault();

        let formData = $(this).serialize();
        $('.btn-primary').prop('disabled', true).text('Enviando...');

        $.ajax({
            // CORRETO: Usamos a ROTA definida no seu ctrlRotas.php
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
