tailwind.config = {
            theme: {
                
                extend: {
                    colors: {
                        primary: '#0047AB',
                        secondary: '#00264d',
                        accent: '#FF6B00',
                        light: '#f5f7fa',
                        // bkheader: '#0c1b3a9a',
                        color: '#0f0f0f',
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
   
