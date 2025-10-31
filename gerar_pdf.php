<?php
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
$html = "
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { color: #333; }
        p { margin: 5px 0; }
    </style>
    <h2>Detalhes do Produto/Serviço</h2>
    <p><strong>Tipo:</strong> {$item['tipo']}</p>
    <p><strong>Nome:</strong> {$item['nome']}</p>
    <p><strong>Descrição:</strong> {$item['descricao']}</p>
    <p><strong>Preço:</strong> R$ " . number_format($item['preco'], 2, ',', '.') . "</p>
    <p><strong>Data de Cadastro:</strong> " . date('d/m/Y', strtotime($item['data_cadastro'])) . "</p>
";

// Gerar o PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("produto_servico_{$id}.pdf", ["Attachment" => true]);
exit;
?>