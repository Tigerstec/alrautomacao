<?php

$senhaPlana = 'Mrc@1977';

$hash = password_hash($senhaPlana, PASSWORD_DEFAULT);

echo "Senha Plana: " . $senhaPlana . "<br>";
echo "Hash Gerado: " . $hash;

?>
