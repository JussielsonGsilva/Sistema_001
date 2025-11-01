<?php
session_start();
include("conexao.php");
date_default_timezone_set('America/Fortaleza');

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
            padding: 0;
        }
        .login-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #d3c55fff;
            padding: 12px 16px 12px 16px;
            margin-bottom: 20px;
            border-radius: 6px;
        }
        a{
            text-decoration: none;
            color: green;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 180px;
            height: 90vh;
            padding-top: 80px;
        }

        .sidebar ul {
           list-style: none;
           padding: 0;
           margin: 0;
        }

        .sidebar ul li {
            margin: 20px 0;
        }

        .sidebar ul li a {
            color: #090909ff;
            text-decoration: none;
            font-size: 14px;
            display: flex;
            align-items: center;
            padding: 2px 12px;
            transition: background 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #cad8e6ff;
            border-left: 4px solid #3498db;
            border-radius: 6px;
        }

        .icon {
            margin-right: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="login-info">
        <!-- <a href="logout.php" class="btn"><b>Sair</b></a> -->
        <strong>Bem-vindo(a):  <?php echo $usuario; ?>!</strong>
        Último login: <?php echo $ultimo_login; ?>
    </div>
    <!-- Sidebar com os ícones -->
    <div class="sidebar">
    <ul>
        <li><a href="#"><span class="icon">🏠</span> Início</a></li>
        <li><a href="dados_cad_user.php"><span class="icon">👤</span> Usuários</a></li>
        <li><a href="cadastro_produto_servico.php"><span class="icon">📝</span> Cadastro de Produtos/Serviços</a></li>
        <li><a href="pesquisar_produto_servico.php"><span class="icon">🔍</span> Pesquisar Produto/Serviço</a></li>
        <li><a href="cadastrar_pagamento.php"><span class="icon">💳</span> Registrar Pagamento</a></li>
        <li><a href="#"><span class="icon">📊</span> Relatórios</a></li>
        <li><a href="#"><span class="icon">⚙️</span> Configurações</a></li>
        <li><a href="logout.php"><span class="icon">🚪</span> Sair</a></li>
    </ul>
    </div>
</table>
</body>
</html>