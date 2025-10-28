<?php
$host = "localhost";
$usuario = "root"; // ou outro usuário, se estiver usando hospedagem externa
$senha = "";       // senha do banco (em XAMPP geralmente é vazia)
$banco = "sistema_login";

// Criar conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verificar conexão
// Entre no arquivo conexao.php
//echo"Conexão Realizada com Sucesso!";
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>