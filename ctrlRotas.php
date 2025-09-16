<?php

// Habilita a exibição de todos os erros para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Obtém a URI, removendo barras extras do início e fim.
// A URI vazia (acesso à raiz) será agora tratada na função abreRota, buscando a rota padrão no JSON.
// Novas linhas (substituição)
$full_uri = $_GET['uri'] ?? '';
$uri_parts = explode('?', $full_uri, 2); // Divide a URI no '?'
$uri = trim($uri_parts[0], '/'); // A primeira parte é a rota

// Sanitiza os dados de GET e POST para evitar injeções básicas
foreach ($_GET as $key => $value) {
    $_GET[$key] = addslashes($value);
}

foreach ($_POST as $key => $value) {
    $_POST[$key] = addslashes($value);
}

// Verifica se a URI corresponde a um arquivo ou diretório existente no sistema
if (file_exists($uri) && !is_dir($uri)) {
    // Se for um arquivo existente, verifica se está dentro de 'public/'
    if (str_starts_with($uri, 'public/')) {
        $fileExtension = pathinfo($uri, PATHINFO_EXTENSION);
        $fileExtension = strtolower($fileExtension);
        $txtContent = array("html", "htm", "css", "js", "json");

        // Se for um tipo de conteúdo de texto (html, css, js, json), usa require
        if (in_array($fileExtension, $txtContent)) {
            require $uri;
        } else {
            // Para outros tipos de arquivos (imagens, PDFs, etc.), lê o arquivo diretamente
            ob_clean(); // Limpa o buffer de saída para evitar cabeçalhos extras
            header('Content-Type: ' . mime_content_type($uri));
            readfile($uri);
            exit();
        }
    } else {
        // Se o arquivo existe mas NÃO está dentro de 'public/', bloqueia o acesso
        http_response_code(404); // Código 403 Forbidden
        die("404 - Acesso Negado a arquivos fora do diretório public.");
    }
} else {
    // Se não for um arquivo existente, tenta abrir como uma rota definida em 'app/rotasTest.json'
    // A função abreRota agora lida com rotas amigáveis e a rota padrão (URI vazia)
    abreRota($uri);
}

/**
 * Função responsável por mapear e carregar as rotas definidas no arquivo JSON.
 * @param string $uri A URI requisitada pelo usuário.
 */
function abreRota($uri) {
    // Carrega o arquivo de rotas
    $rotas = json_decode(file_get_contents("app/rotasTest.json"), true);
    $success = false;

    // A URI vazia ('') será agora usada para procurar a rota padrão no JSON.
    // Ex: {"": "public/index.php"}

    foreach ($rotas as $key => $value) {
        if ($uri === $key) {
            $success = true;
            require $value;
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
