<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Buscar usuário no banco
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $dados = $resultado->fetch_assoc();

        // Verificar senha
        if (password_verify($senha, $dados['senha'])) {
            $_SESSION['usuario'] = $usuario;
            header("Location: sistema_empresa.php");
            exit;
        } else {
            mostrarErro("Senha incorreta.");
        }
    } else {
        mostrarErro("Usuário não encontrado.");
    }

    $stmt->close();
    $conn->close();
}

function mostrarErro($mensagem) {
    echo "<!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <title>Erro de Login</title>
        <style>
            body { font-family: Arial; text-align: center; margin-top: 50px; }
            h2 { color: red; }
            .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 5px; }
        </style>
    </head>
    <body>
        <h2>$mensagem</h2>
        <a href='index.php' class='btn'>Voltar</a>
    </body>
    </html>";
}
?>