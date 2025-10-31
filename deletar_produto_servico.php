<?php
session_start();
include("conexao.php");

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM produtos_servicos WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: pesquisar_produto_servico.php?excluido=1");
        exit;
    } else {
        header("Location: pesquisar_produto_servico.php?erro=1");
        exit;
    }
} else {
    header("Location: pesquisar_produto_servico.php?erro=1");
    exit;
}
?>