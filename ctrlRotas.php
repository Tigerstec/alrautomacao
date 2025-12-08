<?php

// Habilita a exibição de todos os erros para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Obtém a URI, removendo barras extras do início e fim.
$full_uri = $_GET['uri'] ?? '';
$uri_parts = explode('?', $full_uri, 2); // Divide a URI no '?'
$uri = trim($uri_parts[0], '/');

// Sanitiza os dados de GET e POST para evitar injeções básicas
foreach ($_GET as $key => $value) {
    $_GET[$key] = addslashes($value);
}

foreach ($_POST as $key => $value) {
    $_POST[$key] = addslashes($value);
}

// Bloqueia acesso direto a /public/
if ($uri === 'public' || strpos($uri, 'public/') === 0) {
    header('Location: /');
    exit;
}

// Verifica se a URI corresponde a um arquivo ou diretório existente no sistema
if (file_exists($uri) && !is_dir($uri)) {
    if (str_starts_with($uri, 'public/')) {
        $fileExtension = pathinfo($uri, PATHINFO_EXTENSION);
        $fileExtension = strtolower($fileExtension);
        $txtContent = array("html", "htm", "css", "js", "json");

        if (in_array($fileExtension, $txtContent)) {
            require $uri;
        } else {
            ob_clean(); 
            header('Content-Type: ' . mime_content_type($uri));
            readfile($uri);
            exit();
        }
    } else {
        // Se o arquivo existe mas NÃO está dentro de 'public/', bloqueia o acesso
        http_response_code(404);
        die("404 - Acesso Negado a arquivos fora do diretório public.");
    }
} else {
    // Bloqueia tentativas de listar diretórios
    if (is_dir($uri) && !empty($uri)) {
        http_response_code(403);
        die("403 - Acesso à listagem de diretórios não permitido.");
    }
    
    abreRota($uri);
}

function abreRota($uri) {
    $rotasPath = __DIR__ . "/app/etc/routes.json";
    
    if (!file_exists($rotasPath)) {
        http_response_code(500);
        die("500 - Arquivo de configuração de rotas não encontrado.");
    }

    $rotas = json_decode(file_get_contents($rotasPath), true);
    $success = false;

    // A URI vazia ('') será agora usada para procurar a rota padrão no JSON.
    // Ex: {"": "public/index.php"}

    foreach ($rotas as $key => $value) {
        if ($uri === $key) {
            $success = true;
            require __DIR__ . "/" . $value; 
            break;
        }
    }

    if (!$success) {
        http_response_code(404);
        die("404 - Rota ou arquivo não encontrado.");
    }
}


// Função auxiliar para determinar o tipo MIME do arquivo
if (!function_exists('mime_content_type')) {
    function mime_content_type($filename) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $mimetype;
    }
}
