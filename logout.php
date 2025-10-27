<?php
session_start();
session_unset(); // Remove todas as variáveis da sessão
session_destroy(); // Encerra a sessão

// Redireciona para a tela de login--> index.html com mensagem
header("Location: index.php?logout=1");
exit;
?>