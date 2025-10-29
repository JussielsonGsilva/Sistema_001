<?php
session_start();
include("conexao.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Busca o horário do último login
$sql = "SELECT ultimo_login FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);
$dados = mysqli_fetch_assoc($resultado);

// Formata o horário
$ultimo_login = date("d/m/Y á\s H:i", strtotime($dados['ultimo_login']));
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema Empresarial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
        }
        .login-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d3c55fff;
            padding: 12px 16px 12px 16px;
            margin-bottom: 20px;
            border-left: 5px;
        }
        a{
            text-decoration: none;
            color: green;

        }
    </style>
</head>
<body>
    <div class="login-info">
        <a href="logout.php" class="btn"><b>Sair</b></a>
        <strong>Bem-vindo(a):  <?php echo $usuario; ?>!</strong>
        Último login: <?php echo $ultimo_login; ?>
    </div>

    <!-- Aqui você pode adicionar os campos e funcionalidades do sistema -->
</body>
</html>
