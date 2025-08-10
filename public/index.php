<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALR Serviços - Site em Construção</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .construction-animation {
            animation: bounce 2s infinite;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        .gear {
            animation: rotate 4s linear infinite;
        }
        
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        .progress-bar {
            animation: loading 3s ease-in-out infinite;
        }
        
        @keyframes loading {
            0% { width: 0%; }
            50% { width: 75%; }
            100% { width: 0%; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="text-center max-w-2xl mx-auto px-6">
        
        <!-- Título Principal -->
        <h1 class="text-5xl md:text-6xl font-bold text-blue-800 mb-4">
            ALR Automação
        </h1>
        <h1 class="text-5xl md:text-4x1 text-blue-800 mb-4">
            SITE EM CONSTRUÇÃO!
        </h1>
        
        <!-- Subtítulo -->
        <p class="text-xl text-blue-600 mb-8 font-light">
            Estamos trabalhando duro para trazer algo incrível para você!
        </p>
        
        <!-- Barra de Progresso -->
        <div class="mb-8">
            <div class="bg-white rounded-full h-3 shadow-inner overflow-hidden">
                <div class="progress-bar h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full"></div>
            </div>
            <p class="text-blue-500 text-sm mt-2">Em Desenvolvendo...</p>
        </div>

        
        <!-- Rodapé -->
        <div class="text-blue-500 text-sm">
            <p>&copy; 2025 - Todos os direitos reservados</p>
            <p class="mt-1">Voltaremos em breve com novidades!</p>
        </div>
    </div>
</body>
</html>


