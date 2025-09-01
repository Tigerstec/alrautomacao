tailwind.config = {
            theme: {
                
                extend: {
                    colors: {
                        primary: '#0047AB',
                        secondary: '#00264d',
                        accent: '#FF6B00',
                        light: '#f5f7fa',
                        // bkheader: '#0c1b3a9a',
                        bkhdr2: '#ff0000ff',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            }
        }

            //Quantidade de Slides
            document.addEventListener('DOMContentLoaded', () => {
                const container = document.getElementById('testimonial-container');
                const prevBtn = document.getElementById('prev-testimonial');
                const nextBtn = document.getElementById('next-testimonial');
                
                const slides = container.children;
                const totalSlides = slides.length;

                let currentIndex = 0;
                
                //Função Carrossel
                function updateCarousel() {
                    let slidesVisible = 1;
                    if (window.innerWidth >= 1024) {
                        slidesVisible = 3;
                    } else if (window.innerWidth >= 768) {
                        slidesVisible = 2;
                    }

                    const slideWidth = 100 / slidesVisible;
                    
                    const offset = -currentIndex * slideWidth;
                    container.style.transform = `translateX(${offset}%)`;

                    prevBtn.disabled = currentIndex === 0;
                    nextBtn.disabled = currentIndex >= totalSlides - slidesVisible;
                    prevBtn.classList.toggle('opacity-50', prevBtn.disabled);
                    nextBtn.classList.toggle('opacity-50', nextBtn.disabled);
                }

                //Botão "Próximo"
                nextBtn.addEventListener('click', () => {
                    let slidesVisible = 1;
                    if (window.innerWidth >= 1024) {
                        slidesVisible = 3;
                    } else if (window.innerWidth >= 768) {
                        slidesVisible = 2;
                    }

                    if (currentIndex < totalSlides - slidesVisible) {
                        currentIndex++;
                        updateCarousel();
                    }
                });

                //Botão "Anterior"
                prevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateCarousel();
                    }
                });

                window.addEventListener('resize', () => {
                    currentIndex = 0;
                    updateCarousel();
                });

                updateCarousel();
            });

            document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            
        });
    });


    //Animação do header
    document.addEventListener('DOMContentLoaded', function() {
        const headerContainer = document.getElementById('header-container');
        const quemSomosSection = document.getElementById('quem-somos');

        window.addEventListener('scroll', function() {
            // Pega a posição do topo da seção "quem-somos" em relação ao topo da viewport
            const sectionTop = quemSomosSection.getBoundingClientRect().top;
            
            // Verifica se a seção "quem-somos" está na tela (ou um pouco acima dela)
            if (sectionTop <= window.innerHeight / 4) {
                // Adiciona as classes para o estado "esticado"
                headerContainer.classList.add('max-w-full', 'rounded-none');
                headerContainer.classList.remove('max-w-7xl', 'rounded-3xl', 'mt-4');
                
            } else {
                // Remove as classes para voltar ao estado inicial
                headerContainer.classList.remove('max-w-full', 'rounded-none');
                headerContainer.classList.add('max-w-7xl', 'rounded-3xl', 'mt-4');
            }
        });
    });


    //Formulário
    $(document).ready(function() {
        // Intercepta a submissão do formulário
        $('#contact-form').on('submit', function(event) {
            event.preventDefault(); // Previne o envio padrão do formulário

            // Coleta os dados do formulário
            var formData = $(this).serialize();

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