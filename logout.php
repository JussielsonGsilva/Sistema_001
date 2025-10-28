<?php
session_start();        // Inicia a sessão
session_unset();        // Remove todas as variáveis da sessão
session_destroy();      // Encerra a sessão

// Redireciona para a tela de login
header("Location: index.php");
exit;
?>