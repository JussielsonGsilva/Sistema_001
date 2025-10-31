<?php
date_default_timezone_set('America/Fortaleza');
require 'vendor/autoload.php';
use Dompdf\Dompdf;

include("conexao.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID não informado.");
}

$sql = "SELECT * FROM produtos_servicos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Produto ou serviço não encontrado.");
}

$item = $resultado->fetch_assoc();

// Conteúdo HTML do PDF
$html = '
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #333;
        padding: 20px;
    }
    .container {
        border: 2px solid #007BFF;
        padding: 20px;
        border-radius: 10px;
        background-color: #F9F9F9;
        position: relative;
        min-height: 500px;
    }
    h2 {
        color: #007BFF;
        text-align: center;
        margin-bottom: 20px;
    }
    .linha {
        margin: 10px 0;
        padding: 8px;
        border-bottom: 1px solid #CCC;
    }
    .label {
        font-weight: bold;
        color: #555;
    }
    .rodape {
        position: absolute;
        bottom: 20px;
        left: 20px;
        right: 20px;
        font-size: 12px;
        color: #777;
        text-align: center;
        border-top: 1px solid #CCC;
        padding-top: 10px;
    }
</style>

<div class="container">
    <h2>Detalhes do Produto/Serviço</h2>
    <div class="linha"><span class="label">Tipo:</span> ' . htmlspecialchars($item['tipo']) . '</div>
    <div class="linha"><span class="label">Nome:</span> ' . htmlspecialchars($item['nome']) . '</div>
    <div class="linha"><span class="label">Descrição:</span> ' . htmlspecialchars($item['descricao']) . '</div>
    <div class="linha"><span class="label">Preço:</span> R$ ' . number_format($item['preco'], 2, ',', '.') . '</div>
    <div class="linha"><span class="label">Data de Cadastro:</span> ' . date('d/m/Y', strtotime($item['data_cadastro'])) . '</div>
    <div class="rodape">PDF gerado em ' . date('d/m/Y \à\s H:i:s') . '</div>
</div>
';


// Gerar o PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("produto_servico_{$id}.pdf", ["Attachment" => true]);
exit;
?>