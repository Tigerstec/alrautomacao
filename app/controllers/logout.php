<?php
// app/controllers/logout.php

// Inicia a sessão para poder manipulá-la
session_start();

// Destrói todos os dados da sessão (efetivamente faz o logout)
session_destroy();

// Redireciona o usuário de volta para a página de login
header('Location: /alrautomacao/login');
exit();