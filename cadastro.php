<?php
include("conexao.php"); // Conexão com o banco

// Protege os dados recebidos
$usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
$senha = mysqli_real_escape_string($conn, $_POST['senha']);
$confirmar_senha = $_POST['confirmar_senha'];

if ($senha !== $confirmar_senha) {
    echo "<script>
            alert('As Senhas não são Iguais!');
            window.location.href='cadastro.html';
          </script>";
}
// Verifica se o usuário já existe
$sql_verifica = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conn, $sql_verifica);

if (mysqli_num_rows($resultado) > 0) {
    echo "<script>
            alert('Este Usuário já está cadastrado!');
            window.location.href='cadastro.html';
          </script>";
} else {
    // Criptografa a senha antes de salvar
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o novo usuário
    $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senha_hash')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao cadastrar. Tente novamente.');
                window.location.href='cadastro.html';
              </script>";
    }
}
?>
