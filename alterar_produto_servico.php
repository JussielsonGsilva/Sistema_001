<?php
session_start();
include("conexao.php");

$id = $_GET['id'] ?? null;
$mensagem = "";
$tipoClasse = "";

if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1) {
    $mensagem = "✅ Alteração realizada com sucesso!";
    $tipoClasse = "sucesso";
}
// Busca os dados atuais
if ($id) {
    $sql = "SELECT * FROM produtos_servicos WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $item = mysqli_fetch_assoc($resultado);
    if (!$item) {
        die("Produto ou serviço não encontrado.");
    }
} else {
    die("ID não especificado.");
}

// Atualiza os dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $_POST['tipo'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];

    if ($tipo && $nome && $descricao && $preco !== "") {
        $sql = "UPDATE produtos_servicos 
                SET tipo='$tipo', nome='$nome', descricao='$descricao', preco='$preco' 
                WHERE id = $id";
    
        if (mysqli_query($conn, $sql)) {
            header("Location: produto_salvo.php?sucesso=1");
            exit;

        } else {
            $mensagem = "❌ Erro ao alterar: " . mysqli_error($conn);
            $tipoClasse = "erro";
        }
    } else {
        $mensagem = "⚠️ Preencha todos os campos corretamente.";
        $tipoClasse = "alerta";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alterar Produto ou Serviço</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #34495e;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            margin-top: 20px;
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #219150;
        }

        .mensagem {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        .sucesso {
            background: linear-gradient(135deg, #d4edda, #a8e6cf);
            color: #155724;
            border: 2px solid #28a745;
            box-shadow: 0 0 15px rgba(40, 167, 69, 0.4);
            font-size: 18px;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alerta {
            background-color: #fff3cd;
            color: #856404;
        }

        .btn-voltar {
            display: block;
            margin-top: 30px;
            text-align: center;
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            width: fit-content;
        }

        .btn-voltar:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Alterar Produto ou Serviço</h2>

        <?php if ($mensagem) { ?>
            <div class="mensagem <?php echo $tipoClasse; ?>"><?php echo $mensagem; ?></div>
        <?php } ?>

        <form method="POST">
            <label>Tipo:</label>
            <select name="tipo" required>
                <option value="Produto" <?php if ($item['tipo'] == 'Produto') echo 'selected'; ?>>Produto</option>
                <option value="Serviço" <?php if ($item['tipo'] == 'Serviço') echo 'selected'; ?>>Serviço</option>
            </select>

            <label>Nome:</label>
            <input type="text" name="nome" value="<?php echo htmlspecialchars($item['nome']); ?>" required>

            <label>Descrição:</label>
            <textarea name="descricao" rows="4" required><?php echo htmlspecialchars($item['descricao']); ?></textarea>

            <label>Preço (R$):</label>
            <input type="number" name="preco" step="0.01" value="<?php echo htmlspecialchars($item['preco']); ?>" required>

            <button type="submit">Salvar Alterações</button>
        </form>

        <a href="pesquisar_produto_servico.php" class="btn-voltar">← Voltar à Pesquisa</a>
    </div>
</body>
</html>