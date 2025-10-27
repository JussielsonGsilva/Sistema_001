<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Empresarial</title>
    <link rel="stylesheet" href="sistema_empresa.css">
</head>
<body>

<div class="container">
    <h1>Bem-vindo ao Sistema Empresarial</h1>
    <p>Você está logado como <strong><?php echo $_SESSION['usuario']; ?></strong>.</p>
    <a href="logout.php" class="btn">Sair</a>
</div>

</body>
</html>
