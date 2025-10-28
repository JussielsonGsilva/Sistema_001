<?php
include("conexao.php"); // Conexão com o banco
session_start();

$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
$senha = $_POST['senha']; // Não precisa escapar, pois não vai direto pro SQL

// Busca o usuário no banco
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $dados = mysqli_fetch_assoc($resultado);
    
    // Verifica a senha com password_verify
    if (password_verify($senha, $dados['senha'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: sistema_empresa.php");
        exit();
    } else {
        echo "<script>
                alert('Usuário ou Senha Incorreta!');
                window.location.href='index.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Usuário ou Senha Incorreta!');
            window.location.href='index.php';
          </script>";
}
?>