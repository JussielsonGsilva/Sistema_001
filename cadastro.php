<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verificar se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "<!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <title>Erro no Cadastro</title>
            <style>
                body { font-family: Arial; text-align: center; margin-top: 50px; }
                .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 5px; }
            </style>
        </head>
        <body>
            <h2 style='color: red;'>As senhas não coincidem. Tente novamente.</h2>
            <a href='cadastro.html' class='btn'>Voltar</a>
        </body>
        </html>";
        exit;
    }

    // Criptografar a senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir no banco
    $sql = "INSERT INTO usuarios (usuario, senha) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $senha_hash);

    if ($stmt->execute()) {
        echo "<!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <title>Cadastro Realizado</title>
            <style>
                body { font-family: Arial; text-align: center; margin-top: 50px; }
                h2 { color: green; }
                .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; }
            </style>
        </head>
        <body>
            <h2>Usuário cadastrado com sucesso!</h2>
            <a href='index.html' class='btn'>Voltar para Login</a>
        </body>
        </html>";
    } else {
        echo "<!DOCTYPE html>
        <html lang='pt-br'>
        <head>
            <meta charset='UTF-8'>
            <title>Erro no Cadastro</title>
            <style>
                body { font-family: Arial; text-align: center; margin-top: 50px; }
                h2 { color: red; }
                .btn { display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 5px; }
            </style>
        </head>
        <body>
            <h2>Erro ao cadastrar: " . $conn->error . "</h2>
            <a href='cadastro.html' class='btn'>Tentar novamente</a>
        </body>
        </html>";
    }

    $stmt->close();
    $conn->close();
}
?>