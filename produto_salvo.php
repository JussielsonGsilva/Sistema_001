<?php
$mensagem = "";
if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    $mensagem = "✅ Alteração realizada com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Produto Alterado</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            text-align: center;
            margin-top: 90px;
        }

        .mensagem {
            font-size: 20px;
            color: #155724;
            background: linear-gradient(135deg, #d4edda, #a8e6cf);
            border: 2px solid #28a745;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 0 15px rgba(40, 167, 69, 0.4);
        }

        .btn-voltar {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-voltar:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($mensagem) { ?>
            <div class="mensagem"><?php echo $mensagem; ?></div>
        <?php } ?>
        <a href="pesquisar_produto_servico.php" class="btn-voltar">← Voltar à Pesquisa</a>
    </div>
</body>
</html>
