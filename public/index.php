<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALR Automações Industrial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../public/assets/css/index.css">
</head>
<body class="font-sans text-gray-800 bg-light">
<header id="main-header" class="fixed w-full z-50 transition-all duration-500">
    <div id="header-container" class="opacity-90 !bg-light border-2 border-black max-w-7xl mx-auto px-4 py-4 mt-4 -black rounded-3xl text-white shadow-md transition-all duration-500">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="../public/assets/images/logo.png" alt="Logo" class="h-12">
            </div>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="#inicio" class="text-black hover:text-gray-400 font-medium transition-transform duration-200 hover:-translate-y-0.5">Início</a>
                <a href="#quem-somos" class="text-black hover:text-gray-400 font-medium transition-transform duration-200 hover:-translate-y-0.5">Quem Somos</a>
                <a href="#servicos" class="text-black hover:text-gray-400 font-medium transition-transform duration-200 hover:-translate-y-0.5">Serviços</a>
                <a href="#projetos" class="text-black hover:text-gray-400 font-medium transition-transform duration-200 hover:-translate-y-0.5">Projetos</a>
                <a href="#contato" class="text-black hover:text-gray-400 font-medium transition-transform duration-200 hover:-translate-y-0.5">Contato</a>
                <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-full transition-all duration-300 hover:scale-105">
                    <a href="admin">Admin</a>
                </button>
            </div>
            
            <div class="md:hidden">
                <button id="menu-toggle" class="text-black focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="mobile-menu" class="md:hidden hidden pt-4 pb-2 text-white">
            <div class="flex flex-col space-y-3">
                <a href="#inicio" class="text-black hover:text-blue-800 font-medium">Início</a>
                <a href="#quem-somos" class="text-black hover:text-blue-800 font-medium">Quem Somos</a>
                <a href="#servicos" class="text-black hover:text-blue-800 font-medium">Serviços</a>
                <a href="#projetos" class="text-black hover:text-blue-800 font-medium">Projetos</a>
                <a href="#contato" class="text-black hover:text-blue-800 font-medium">Contato</a>
            </div>
            <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-full transition-all duration-300 hover:scale-105">
                    <a href="admin">Admin</a>
                </button>
        </div>
    </div>
</header>
    <section id="inicio" class="hero-bg min-h-screen flex items-center pt-16 relative">
    <div class="container mx-auto px-4 py-20 flex flex-col items-center">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-white mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Soluções Inteligentes em Automação Industrial
                </h1>
                <p class="text-xl mb-8 opacity-90">
                    Transformando processos industriais com tecnologia de ponta e conhecimento técnico para aumentar sua produtividade.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#contato" class="btn-primary bg-accent hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg inline-block transition-transform duration-300 hover:scale-105">
                        Solicitar Orçamento
                    </a>
                    <a href="#servicos" class="bg-transparent border-2 border-white text-white font-medium py-3 px-6 rounded-lg inline-block hover:bg-white hover:text-primary transition-all duration-300 hover:scale-105">
                        Nossos Serviços
                    </a>
                </div>
            </div>

            <div class="md:w-1/2 flex justify-center">
            <img src="../public/assets/images/engrenagem.gif" class="max-w-full h-auto rounded-lg " width="640" height="360">
            </div>
        </div>
    </div>

    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2">
        <a href="#quem-somos" class="text-[#FF6B00] text-3xl animate-bounce">
            <i class="fa-solid fa-chevron-down"></i>
        </a>
    </div>
</section>


    <section id="quem-somos" class="py-20 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Quem Somos</h2>
                <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Conheça a ALR Automações Industrial, referência em soluções tecnológicas para o setor industrial.</p>
            </div>
            
            <div class="flex flex-col md:flex-row items-center js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
                <div class="md:w-1/2 mb-10 md:mb-0 md:pr-10">
                    <div class="relative">
                        <div class="bg-primary w-64 h-64 rounded-full absolute -z-10 -top-6 -left-6"></div>
                        <svg class="w-full max-w-lg mx-auto" viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg">
                            <rect x="50" y="50" width="500" height="300" rx="10" fill="#f5f5f5" />
                            <rect x="80" y="80" width="440" height="240" rx="5" fill="#e0e0e0" />
                            <rect x="120" y="120" width="360" height="160" rx="5" fill="#d0d0d0" />
                            <circle cx="300" cy="200" r="60" fill="#0047AB" />
                            <path d="M270 180 L330 220 M330 180 L270 220" stroke="white" stroke-width="8" stroke-linecap="round" />
                            <rect x="120" y="300" width="80" height="20" rx="5" fill="#0047AB" />
                            <rect x="220" y="300" width="80" height="20" rx="5" fill="#0047AB" />
                            <rect x="320" y="300" width="80" height="20" rx="5" fill="#0047AB" />
                            <rect x="420" y="300" width="60" height="20" rx="5" fill="#FF6B00" />
                        </svg>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Nossa História</h3>
                    <p class="text-gray-600 mb-6">A ALR Automações Industrial nasceu da paixão por tecnologia e inovação. Há mais de 15 anos no mercado, nos especializamos em desenvolver soluções personalizadas que otimizam processos industriais, reduzem custos operacionais e aumentam a produtividade de nossos clientes.</p>
                    
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Nossa Missão</h3>
                    <p class="text-gray-600 mb-6">Fornecer soluções tecnológicas inovadoras e confiáveis em automação industrial, contribuindo para o crescimento sustentável de nossos clientes através da excelência técnica e compromisso com resultados.</p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="flex items-center">
                            <div class="bg-accent rounded-full p-2 mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Equipe Qualificada</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-accent rounded-full p-2 mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Tecnologia de Ponta</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-accent rounded-full p-2 mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Soluções Personalizadas</span>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-accent rounded-full p-2 mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700">Suporte Contínuo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="servicos" class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <video class="absolute inset-0 w-full h-full object-cover" autoplay loop muted>
            <source src="../public/assets/images/alr.mp4" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>

    <div class="container relative z-10 mx-auto px-4">
        <div class="text-center mb-16 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Nossos Serviços</h2>
            <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">Oferecemos soluções completas em automação industrial para otimizar seus processos e aumentar sua produtividade.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
                <div class="h-48 bg-primary flex items-center justify-center">
                    <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Automação de Processos</h3>
                    <p class="text-gray-600 mb-4">Desenvolvimento e implementação de sistemas automatizados para otimizar processos industriais, reduzir custos e aumentar a eficiência operacional.</p>
                </div>
            </div>
            <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out" style="transition-delay: 150ms;">
                <div class="h-48 bg-primary flex items-center justify-center">
                    <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Sistemas de Controle</h3>
                    <p class="text-gray-600 mb-4">Projeto e implementação de sistemas de controle industrial, incluindo CLPs, IHMs, SCADA e sistemas de supervisão para monitoramento em tempo real.</p>
                </div>
            </div>
            <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out" style="transition-delay: 300ms;">
                <div class="h-48 bg-primary flex items-center justify-center">
                    <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Integração de Sistemas</h3>
                    <p class="text-gray-600 mb-4">Integração de sistemas legados com novas tecnologias, permitindo a comunicação eficiente entre diferentes equipamentos e plataformas.</p>
                </div>
            </div>
            <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out" style="transition-delay: 450ms;">
                <div class="h-48 bg-primary flex items-center justify-center">
                    <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Manutenção Preditiva</h3>
                    <p class="text-gray-600 mb-4">Implementação de sistemas de monitoramento e análise para prever falhas em equipamentos, reduzindo paradas não programadas e custos de manutenção.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <section id="projetos" class="py-20 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Projetos Realizados</h2>
                <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Conheça alguns dos nossos projetos de sucesso em diferentes segmentos industriais.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
                    <div class="h-56 relative">
                        <div class="flex justify-center h-full w-full">
                            <img class="w-full h-full object-cover" src="../public/assets/images/panasonic.png">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Automação de Linha de Produção</h3>
                        <p class="text-gray-600 mb-4">Tela de interface para controle automático de célula de usinagem do cesto da máquina de lavar Panasonic, permitindo ajuste de posicionadores, monitoramento de servos, receitas de produção e diagnósticos em tempo real.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2024</span>

                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out" style="transition-delay: 150ms;">
                    <div class="h-56 relative">
                        <div class="flex justify-center h-full w-full">
                            <img class="w-full h-full object-cover" src="../public/assets/images/bausano.png">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Supervisório Siemens Wincc</h3>
                        <p class="text-gray-600 mb-4">Tela de interface desenvolvida em SIMATIC HMI para controle e monitoramento da extrusora Bausano MD 130-25 Plus, permitindo ajuste de parâmetros de processo, supervisão de alarmes e gestão de manutenção preventiva.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2025</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out" style="transition-delay: 300ms;">
                    <div class="h-56 relative">
                        <div class="flex justify-center h-full w-full">
                            <img class="w-full h-full object-cover" src="../public/assets/images/escania.png">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Montagem do Coletor Scania</h3>
                        <p class="text-gray-600 mb-4">Tela de supervisório desenvolvida em Siemens WinCC para a linha de montagem do coletor de escape da Scania, permitindo monitorar estados da máquina, gerenciar alarmes, acessar manuais e acompanhar todo o processo produtivo.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2023</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
                    <div class="h-56 relative">
                        <div class="flex justify-center h-full w-full">
                            <img class="w-full h-full object-cover" src="../public/assets/images/painelcontrole.png">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Montagem de Painéis de Automação</h3>
                        <p class="text-gray-600 mb-4">Projeto de montagem de painéis elétricos para controle de automação industrial, incluindo inversores, disjuntores, relés e sistemas de proteção, garantindo confiabilidade, segurança e eficiência no processo produtivo.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2025</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out" style="transition-delay: 150ms;">
                    <div class="h-56 relative">
                        <div class="flex justify-center h-full w-full">
                            <img class="w-full h-full object-cover" src="../public/assets/images/extrusora.png">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Menu Extrusora</h3>
                        <p class="text-gray-600 mb-4">Tela de supervisório desenvolvida em DIA Screen Delta para controle de extrusora, com acesso a operação, receitas, gráficos, ajustes de PID, configuração de alarmes e histórico de falhas, otimizando o processo de extrusão.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2025</span>
                        </div>
                    </div>
                </div>  

                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:shadow-2xl hover:-translate-y-2 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out" style="transition-delay: 300ms;">
                    <div class="h-56 relative">
                        <div class="flex justify-center h-full w-full">
                            <img class="w-full h-full object-cover" src="../public/assets/images/lavagem.png">
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Retro Lavagem de Filtros</h3>
                        <p class="text-gray-600 mb-4">Tela de supervisório desenvolvida em Siemens Simatic HMI para controle do processo de retro lavagem de filtros da caldeiraria, permitindo visualização do ciclo de filtragem, monitoramento de bombas, válvulas e parâmetros em tempo real.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2025</span>
                        </div>
                    </div>
                </div>  
            </div> 
    </section>

    <section class="py-20 bg-white overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16 js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">O Que Nossos Clientes Dizem</h2>
            <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Veja os depoimentos de alguns de nossos clientes satisfeitos com nossas soluções.</p>
        </div>
        
        <div class="relative js-scroll-animate opacity-0 translate-y-5 transition-all duration-700 ease-out">
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out" id="testimonial-container">
                    <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                        <div class="bg-gray-50 rounded-lg shadow-lg p-8 h-full flex flex-col">
                            <div class="flex items-center mb-6">
                                <div class="text-yellow-400 flex">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                            <p class="text-gray-600 italic mb-6 flex-grow">Eu Marcelo,da empresa Bausano do Brasil Com. Imp. e Exp. Ltda. Temos ótimas referências qto ao trabalho e conhecimento do profissional Marcos R. Carapeta. Há mais de 15 anos de trabalho. Desde sempre muito atencioso e profissional e atualizado ao mercado.</p>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center"><span class="text-primary font-bold">MC</span></div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-800">Marcelo</h4>
                                    <p class="text-gray-600 text-sm">Bausano do Brasil Com. Imp. e Exp. Ltda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                        <div class="bg-gray-50 rounded-lg shadow-lg p-8 h-full flex flex-col">
                            <div class="flex items-center mb-6">
                            <div class="text-yellow-400 flex">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                            <p class="text-gray-600 italic mb-6 flex-grow">"Aqui quem está falando é o Renato, Gestor da Link Plástico!
                                Gostaria de registrar meu agradecimento pelo excelente trabalho prestado em nossa área de produção, suas habilidades nas  programações, competência, dedicação e profissionalismo têm sido fundamentais para a eficiência e qualidade dos nossos processos. O trabalho realizado contribui significativamente para o sucesso da nossa produção.
                                Muito obrigado pela parceria de sempre!."</p>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center"><span class="text-primary font-bold">RN</span></div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-800">Renato</h4>
                                    <p class="text-gray-600 text-sm">Gestor da Link Plástico.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                        <div class="bg-gray-50 rounded-lg shadow-lg p-8 h-full flex flex-col">
                            <div class="flex items-center mb-6">
                                <div class="text-yellow-400 flex">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                            <p class="text-gray-600 italic mb-6 flex-grow">"O projeto de eficiência energética desenvolvido pela ALR superou todas as nossas expectativas. Conseguimos reduzir o consumo de energia em 25% e o retorno sobre o investimento foi alcançado em menos de um ano."</p>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center"><span class="text-primary font-bold">MA</span></div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-800">Marcos Almeida</h4>
                                    <p class="text-gray-600 text-sm">Diretor de Operações, Aço Forte S.A.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                        <div class="bg-gray-50 rounded-lg shadow-lg p-8 h-full flex flex-col">
                            <div class="flex items-center mb-6">
                                <div class="text-yellow-400 flex">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </div>
                            </div>
                            <p class="text-gray-600 italic mb-6 flex-grow">"O projeto de eficiência energética desenvolvido pela ALR superou todas as nossas expectativas. Conseguimos reduzir o consumo de energia em 25% e o retorno sobre o investimento foi alcançado em menos de um ano."</p>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center"><span class="text-primary font-bold">MA</span></div>
                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-800">Marcos Almeida</h4>
                                    <p class="text-gray-600 text-sm">Diretor de Operações, Aço Forte S.A.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button id="prev-testimonial" class="absolute top-1/2 -left-4 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 focus:outline-none z-10">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </button>
            
            <button id="next-testimonial" class="absolute top-1/2 -right-4 transform -translate-y-1/2 bg-white rounded-full p-2 shadow-md hover:bg-gray-100 focus:outline-none z-10">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
</section>

<section id="contato" class="hero-bg min-h-screen flex items-center pt-16">
    <div class="container mx-auto px-4 py-20">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <div class="lg:w-1/2 text-white text-center lg:text-left mb-10 lg:mb-0">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 leading-tight">Solicite seu Serviço</h2>
                <div class="w-24 h-1 bg-accent mx-auto lg:mx-0 mb-6"></div>
                <p class="text-xl opacity-90">
                    Descreva seu problema e suas informações para que nossa equipe possa analisar e entrar em contato com a melhor solução para sua empresa.
                </p>
            </div>

            <div class="lg:w-1/2 w-full">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm p-8 rounded-lg shadow-xl text-white">
                    <form id="contact-form">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2">Nome</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Seu nome completo" required>
                            </div>

                            <div>
                                <label for="company" class="block text-sm font-medium mb-2">Empresa</label>
                                <input type="text" id="company" name="company" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Nome da sua empresa" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Seu melhor email" required>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium mb-2">Telefone/WhatsApp</label>
                                <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Ex: (99) 99999-9999" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="location" class="block text-sm font-medium mb-2">Cidade - Estado</label>
                                <input type="text" id="location" name="location" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Ex: São Paulo - SP" required>
                            </div>
                            <div>
                                <label for="service" class="block text-sm font-medium mb-2">Tipo do serviço</label>
                                <input type="text" id="service" name="service" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Informe o tipo de serviço" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium mb-2">Descrição do Problema</label>
                            <textarea id="description" name="description" rows="5" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Descreva brevemente sua necessidade ou problema" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn-primary bg-accent hover:bg-orange-600 text-white font-medium py-3 px-8 rounded-lg inline-block w-full transition-transform duration-300 hover:scale-105">
                                Enviar Solicitação
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> 

<footer class="bg-primary text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center md:text-left">
                <p class="text-gray-300 mb-4">
                    Soluções inteligentes em automação industrial para otimizar seus processos e aumentar sua produtividade.
                </p>
                <div class="flex justify-center md:justify-start space-x-4">
                    <a href="https://www.instagram.com/alr.automacao?igsh=MTVpanIxcHI5aTl6YQ==" target="_blank" class="hover:text-accent transition-colors duration-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a href="https://whatsapp.com" target="_blank" class="hover:text-accent transition-colors duration-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold mb-4">Links Rápidos</h3>
                <ul class="space-y-2">
                    <li><a href="#inicio" class="text-gray-300 hover:text-accent transition-colors duration-300">Início</a></li>
                    <li><a href="#quem-somos" class="text-gray-300 hover:text-accent transition-colors duration-300">Quem Somos</a></li>
                    <li><a href="#servicos" class="text-gray-300 hover:text-accent transition-colors duration-300">Serviços</a></li>
                    <li><a href="#projetos" class="text-gray-300 hover:text-accent transition-colors duration-300">Projetos</a></li>
                    <li><a href="#contato" class="text-gray-300 hover:text-accent transition-colors duration-300">Contato</a></li>
                </ul>
            </div>

            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold mb-4">Contato</h3>
                <div class="space-y-3">
                    <p class="flex items-center justify-center md:justify-start">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Guarulhos, SP - Brasil
                    </p>
                    <p class="flex items-center justify-center md:justify-start">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        marcos@alrautomacao.com.br
                    </p>
                    <p class="flex items-center justify-center md:justify-start">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        +55 (11) 2479-2417
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-primary">
        <div class="container mx-auto px-4 py-4">
            <p class="text-center text-gray-400 text-sm">
                © 2025 ALR Automações Industrial. Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>

<div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div id="result-modal" class="bg-white p-8 rounded-lg shadow-2xl max-w-sm w-full text-center relative">
        <h3 id="modal-title" class="text-2xl font-bold mb-4"></h3>
        <p id="modal-message" class="text-gray-700 mb-6"></p>
        <button id="close-form-modal" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
            Fechar
        </button>
    </div>
</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../public/assets/js/index.js"></script>
    <script src="../public/assets/js/formIndex.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const intersectionCallback = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-5');
                        observer.unobserve(entry.target);
                    }
                });
            };

            const observer = new IntersectionObserver(intersectionCallback, observerOptions);

            const targets = document.querySelectorAll('.js-scroll-animate');
            targets.forEach(target => {
                observer.observe(target);
            });
        });
    </script>
</body>

</html>
