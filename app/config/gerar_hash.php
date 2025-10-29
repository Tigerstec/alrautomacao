<?php

// A senha que queremos criptografar
$senhaPlana = '123456';

// Gera o hash usando o algoritmo padrão e mais seguro do seu PHP
$hash = password_hash($senhaPlana, PASSWORD_DEFAULT);

// Imprime o hash na tela
echo "Senha Plana: " . $senhaPlana . "<br>";
echo "Hash Gerado: " . $hash;

?>