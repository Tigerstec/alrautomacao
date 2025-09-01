<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALR Automações Industrial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="public/assets/css/index.css">
</head>
<body class="font-sans text-gray-800 bg-light">
    <!-- Header/Navbar -->
  <header id="main-header" class="fixed w-full z-50 transition-all duration-500">
   <div id="header-container" class="opacity-90 !bg-light border-2 border-black max-w-7xl mx-auto px-4 py-4 mt-4 -black rounded-3xl text-white shadow-md transition-all duration-500">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="public/assets/images/logo.png" alt="Logo" class="h-12">
            </div>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="#inicio" class="text-black hover:text-gray-400 font-medium">Início</a>
                <a href="#quem-somos" class="text-black hover:text-gray-400 font-medium">Quem Somos</a>
                <a href="#servicos" class="text-black hover:text-gray-400 font-medium">Serviços</a>
                <a href="#projetos" class="text-black hover:text-gray-400 font-medium">Projetos</a>
                <a href="#contato" class="text-black hover:text-gray-400 font-medium">Contato</a>
                <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-full transition-colors duration-200">
                    Log in
                </button>
            </div>
            
            <div class="md:hidden">
                <button id="menu-toggle" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div id="mobile-menu" class="md:hidden hidden pt-4 pb-2 text-white">
            <div class="flex flex-col space-y-3">
                <a href="#inicio" class="text-white hover:text-gray-400 font-medium">Início</a>
                <a href="#quem-somos" class="text-white hover:text-gray-400 font-medium">Quem Somos</a>
                <a href="#servicos" class="text-white hover:text-gray-400 font-medium">Serviços</a>
                <a href="#projetos" class="text-white hover:text-gray-400 font-medium">Projetos</a>
                <a href="#contato" class="text-white hover:text-gray-400 font-medium">Contato</a>
            </div>
        </div>
    </div>
</header>
    <!-- Hero Section -->
    <section id="inicio" class="hero-bg min-h-screen flex items-center pt-16">
        <div class="container mx-auto px-4 py-20">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-white mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Soluções Inteligentes em Automação Industrial</h1>
                    <p class="text-xl mb-8 opacity-90">Transformando processos industriais com tecnologia de ponta e conhecimento técnico para aumentar sua produtividade.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#contato" class="btn-primary bg-accent hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg inline-block">
                            Solicitar Orçamento
                        </a>
                        <a href="#servicos" class="bg-transparent border-2 border-white text-white font-medium py-3 px-6 rounded-lg inline-block hover:bg-white hover:text-primary transition duration-300">
                            Nossos Serviços
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <svg class="w-full max-w-md" viewBox="0 0 600 400" xmlns="http://www.w3.org/2000/svg">
                        <rect x="100" y="50" width="400" height="300" rx="10" fill="#f0f0f0" />
                        <rect x="130" y="80" width="340" height="240" rx="5" fill="#e0e0e0" />
                        <circle cx="300" cy="200" r="80" fill="#d0d0d0" />
                        <path d="M300 120 L300 200 L360 200" stroke="#FF6B00" stroke-width="8" stroke-linecap="round" />
                        <circle cx="300" cy="200" r="10" fill="#FF6B00" />
                        <rect x="150" y="100" width="60" height="30" rx="5" fill="#0047AB" />
                        <rect x="150" y="150" width="60" height="30" rx="5" fill="#0047AB" />
                        <rect x="150" y="200" width="60" height="30" rx="5" fill="#0047AB" />
                        <rect x="150" y="250" width="60" height="30" rx="5" fill="#0047AB" />
                        <rect x="390" y="100" width="60" height="30" rx="5" fill="#0047AB" />
                        <rect x="390" y="150" width="60" height="30" rx="5" fill="#0047AB" />
                        <rect x="390" y="200" width="60" height="30" rx="5" fill="#0047AB" />
                        <rect x="390" y="250" width="60" height="30" rx="5" fill="#0047AB" />
                        <circle cx="180" cy="115" r="5" fill="#FF6B00" />
                        <circle cx="180" cy="165" r="5" fill="#FF6B00" />
                        <circle cx="180" cy="215" r="5" fill="#FF6B00" />
                        <circle cx="180" cy="265" r="5" fill="#FF6B00" />
                        <circle cx="420" cy="115" r="5" fill="#FF6B00" />
                        <circle cx="420" cy="165" r="5" fill="#FF6B00" />
                        <circle cx="420" cy="215" r="5" fill="#FF6B00" />
                        <circle cx="420" cy="265" r="5" fill="#FF6B00" />
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Quem Somos Section -->
    <section id="quem-somos" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Quem Somos</h2>
                <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Conheça a ALR Automações Industrial, referência em soluções tecnológicas para o setor industrial.</p>
            </div>
            
            <div class="flex flex-col md:flex-row items-center">
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
                    
                    <button class="btn-primary bg-primary hover:bg-secondary text-white font-medium py-3 px-6 rounded-lg inline-flex items-center">
                        <span>Conheça Nossa Equipe</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="servicos" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nossos Serviços</h2>
                <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Oferecemos soluções completas em automação industrial para otimizar seus processos e aumentar sua produtividade.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Automação de Processos</h3>
                        <p class="text-gray-600 mb-4">Desenvolvimento e implementação de sistemas automatizados para otimizar processos industriais, reduzir custos e aumentar a eficiência operacional.</p>
                        <button class="service-details-btn text-primary font-medium flex items-center" data-service="automacao">
                            <span>Saiba Mais</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Sistemas de Controle</h3>
                        <p class="text-gray-600 mb-4">Projeto e implementação de sistemas de controle industrial, incluindo CLPs, IHMs, SCADA e sistemas de supervisão para monitoramento em tempo real.</p>
                        <button class="service-details-btn text-primary font-medium flex items-center" data-service="controle">
                            <span>Saiba Mais</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Eficiência Energética</h3>
                        <p class="text-gray-600 mb-4">Soluções para otimização do consumo de energia em ambientes industriais, reduzindo custos operacionais e promovendo sustentabilidade.</p>
                        <button class="service-details-btn text-primary font-medium flex items-center" data-service="energia">
                            <span>Saiba Mais</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Service 4 -->
                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Integração de Sistemas</h3>
                        <p class="text-gray-600 mb-4">Integração de sistemas legados com novas tecnologias, permitindo a comunicação eficiente entre diferentes equipamentos e plataformas.</p>
                        <button class="service-details-btn text-primary font-medium flex items-center" data-service="integracao">
                            <span>Saiba Mais</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Service 5 -->
                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Manutenção Preditiva</h3>
                        <p class="text-gray-600 mb-4">Implementação de sistemas de monitoramento e análise para prever falhas em equipamentos, reduzindo paradas não programadas e custos de manutenção.</p>
                        <button class="service-details-btn text-primary font-medium flex items-center" data-service="manutencao">
                            <span>Saiba Mais</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Service 6 -->
                <div class="service-card bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-48 bg-primary flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Indústria 4.0</h3>
                        <p class="text-gray-600 mb-4">Implementação de tecnologias da Indústria 4.0, como IoT industrial, Big Data e Inteligência Artificial para transformação digital de processos industriais.</p>
                        <button class="service-details-btn text-primary font-medium flex items-center" data-service="industria40">
                            <span>Saiba Mais</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Modal -->
    <div id="service-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 id="modal-title" class="text-2xl font-bold text-gray-800"></h3>
                    <button id="close-service-modal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modal-content" class="text-gray-600"></div>
                <div class="mt-8 flex justify-end">
                    <button id="modal-close-btn" class="bg-primary hover:bg-secondary text-white font-medium py-2 px-6 rounded-lg">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Section -->
    <section id="projetos" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Projetos Realizados</h2>
                <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Conheça alguns dos nossos projetos de sucesso em diferentes segmentos industriais.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-56 bg-gray-300 relative">
                        <svg class="w-full h-full" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" fill="#e0e0e0" />
                            <rect x="50" y="50" width="300" height="200" fill="#d0d0d0" />
                            <circle cx="200" cy="150" r="80" fill="#0047AB" />
                            <rect x="160" y="110" width="80" height="80" fill="#FF6B00" />
                        </svg>
                        <div class="absolute inset-0 bg-primary bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <button class="bg-white text-primary font-medium py-2 px-4 rounded-lg project-details-btn" data-project="projeto1">Ver Detalhes</button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Automação de Linha de Produção</h3>
                        <p class="text-gray-600 mb-4">Implementação de sistema completo de automação para linha de produção no setor alimentício.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2022</span>
                        </div>
                    </div>
                </div>
                
                <!-- Project 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-56 bg-gray-300 relative">
                        <svg class="w-full h-full" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" fill="#e0e0e0" />
                            <rect x="50" y="50" width="300" height="200" fill="#d0d0d0" />
                            <circle cx="120" cy="150" r="50" fill="#0047AB" />
                            <circle cx="280" cy="150" r="50" fill="#FF6B00" />
                            <rect x="170" y="100" width="60" height="100" fill="#0047AB" />
                        </svg>
                        <div class="absolute inset-0 bg-primary bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <button class="bg-white text-primary font-medium py-2 px-4 rounded-lg project-details-btn" data-project="projeto2">Ver Detalhes</button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Sistema SCADA para Indústria Química</h3>
                        <p class="text-gray-600 mb-4">Desenvolvimento e implementação de sistema SCADA para monitoramento e controle de processos químicos.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2021</span>
                        </div>
                    </div>
                </div>
                
                <!-- Project 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="h-56 bg-gray-300 relative">
                        <svg class="w-full h-full" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" fill="#e0e0e0" />
                            <rect x="50" y="50" width="300" height="200" fill="#d0d0d0" />
                            <rect x="100" y="100" width="200" height="100" fill="#0047AB" />
                            <circle cx="150" cy="150" r="30" fill="#FF6B00" />
                            <circle cx="250" cy="150" r="30" fill="#FF6B00" />
                        </svg>
                        <div class="absolute inset-0 bg-primary bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <button class="bg-white text-primary font-medium py-2 px-4 rounded-lg project-details-btn" data-project="projeto3">Ver Detalhes</button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Eficiência Energética em Siderúrgica</h3>
                        <p class="text-gray-600 mb-4">Implementação de sistema de gestão energética para redução de consumo em processos siderúrgicos.</p>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Concluído em 2023</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <button class="btn-primary bg-primary hover:bg-secondary text-white font-medium py-3 px-6 rounded-lg inline-flex items-center">
                    <span>Ver Todos os Projetos</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Project Modal -->
    <div id="project-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 id="project-modal-title" class="text-2xl font-bold text-gray-800"></h3>
                    <button id="close-project-modal" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="project-modal-content" class="text-gray-600"></div>
                <div class="mt-8 flex justify-end">
                    <button id="project-modal-close-btn" class="bg-primary hover:bg-secondary text-white font-medium py-2 px-6 rounded-lg">Fechar</button>
                </div>
            </div>
        </div>
    </div>
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">O Que Nossos Clientes Dizem</h2>
            <div class="w-24 h-1 bg-accent mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Veja os depoimentos de alguns de nossos clientes satisfeitos com nossas soluções.</p>
        </div>
        
        <div class="relative">
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
            <!-- Título e Descrição (Coluna Esquerda) -->
            <div class="lg:w-1/2 text-white text-center lg:text-left mb-10 lg:mb-0">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 leading-tight">Solicite seu Serviço</h2>
                <div class="w-24 h-1 bg-accent mx-auto lg:mx-0 mb-6"></div>
                <p class="text-xl opacity-90">
                    Descreva seu problema e suas informações para que nossa equipe possa analisar e entrar em contato com a melhor solução para sua empresa.
                </p>
            </div>

            <!-- Formulário (Coluna Direita) -->
            <div class="lg:w-1/2 w-full">
                <div class="bg-white bg-opacity-10 backdrop-blur-sm p-8 rounded-lg shadow-xl text-white">
                    <!-- O formulário agora envia os dados para 'process_form.php' via AJAX -->
                    <form id="contact-form" action="#" method="POST"> <!-- Removido o action="processar-formulario" para que o JS controle -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Nome -->
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2">Nome</label>
                                <input type="text" id="name" name="name" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Seu nome completo" required>
                            </div>

                            <!-- Empresa -->
                            <div>
                                <label for="company" class="block text-sm font-medium mb-2">Empresa</label>
                                <input type="text" id="company" name="company" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Nome da sua empresa" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Seu melhor email" required>
                            </div>

                            <!-- Telefone/WhatsApp -->
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

                        <!-- Descrição do Problema -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium mb-2">Descrição do Problema</label>
                            <textarea id="description" name="description" rows="5" class="w-full px-4 py-3 bg-white bg-opacity-20 rounded-md border border-white border-opacity-30 focus:outline-none focus:ring-2 focus:ring-accent placeholder-gray-300 transition duration-200" placeholder="Descreva brevemente sua necessidade ou problema" required></textarea>
                        </div>

                        <!-- Botão de Envio -->
                        <div class="text-center">
                            <button type="submit" class="btn-primary bg-accent hover:bg-orange-600 text-white font-medium py-3 px-8 rounded-lg inline-block w-full">
                                Enviar Solicitação
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Overlay do Modal -->
<div id="modal-overlay" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <!-- Modal de Resultado -->
    <div id="result-modal" class="bg-white p-8 rounded-lg shadow-2xl max-w-sm w-full text-center relative">
        <h3 id="modal-title" class="text-2xl font-bold mb-4"></h3>
        <p id="modal-message" class="text-gray-700 mb-6"></p>
        <button id="close-form-modal" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
            Fechar
        </button>
    </div>
</div>

<!-- Inclua jQuery antes do seu script principal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="public/assets/js/index.js"></script>
</body>
</html>