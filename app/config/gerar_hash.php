<?php

require_once __DIR__ . '/EnvLoader.php';

use app\config\EnvLoader;

EnvLoader::load();

$senhaPlana = EnvLoader::get('ADMIN_PASSWORD');

$hash = password_hash($senhaPlana, PASSWORD_DEFAULT);

echo "Hash Gerado: " . $hash;

?>
