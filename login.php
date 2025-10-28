<?php
include("conexao.php");
session_start();

$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $dados = mysqli_fetch_assoc($resultado);

    if (password_verify($senha, $dados['senha'])) {
        $_SESSION['usuario'] = $usuario;

        // Registra o horário do login direto no banco de dados
        // Define o fuso horário para Teresina (segue o mesmo de Fortaleza)
        date_default_timezone_set('America/Fortaleza');
        // Captura a data e hora atual no formato brasileiro
        $agora = date("Y-m-d H:i:s"); // formato compatível com DATETIME
        // Atualiza o banco com o horário ajustado
        $sql_login = "UPDATE usuarios SET ultimo_login = '$agora' WHERE usuario = '$usuario'";
        mysqli_query($conn, $sql_login);
        // Redireciona para o sistema
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