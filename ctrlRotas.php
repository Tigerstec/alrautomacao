<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$uri = trim(parse_url($_GET['uri'] ?? '', PHP_URL_PATH), '/');


foreach ($_GET as $key => $value) {
    $_GET[$key] = addslashes($_GET[$key]);
}

foreach ($_POST as $key => $value) {
    $_POST[$key] = addslashes($_POST[$key]);
}

if (!file_exists($uri) || is_dir($uri)) {        
        abreRota($uri);
} else {
    if (str_starts_with($uri, 'public/')) {
        $fileExtension = pathinfo($uri, PATHINFO_EXTENSION);
        $fileExtension = strtolower($fileExtension);
        $txtContent = array("html", "htm", "css", "js", "json");
        if ( in_array( $fileExtension, $txtContent ) ){
            require $uri;
        }else{
            ob_clean();
            header('Content-Type: '. $fileExtension );
            readfile($uri);
        }
    } 
} 

function abreRota( $uri ){
    $rotas = json_decode( file_get_contents("app/rotasTest.json"));
    $success = false;
    foreach ($rotas as $key => $value) {
        if (  $uri === $key ){
            $success = true;
            require $value;
        }
    }
    if(! $success){
        http_response_code(404);
        die("404 - Arquivo não encontrado.");
    }
}



