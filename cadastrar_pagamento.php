<?php
include("conexao.php");

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $nome = $_POST['nome'];
    $responsavel = $_POST['responsavel'];
    $telefone = $_POST['telefone'];
    $produto_servico_id = $_POST['produto_servico_id'];

    // Upload do comprovante
    $comprovante_nome = $_FILES['comprovante']['name'];
    $comprovante_temp = $_FILES['comprovante']['tmp_name'];
    $destino = "comprovantes/" . $comprovante_nome;

    if (move_uploaded_file($comprovante_temp, $destino)) {
        $sql = "INSERT INTO pagamentos (cpf_cnpj, nome, responsavel, telefone, comprovante_pagamento, produto_servico_id)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $cpf_cnpj, $nome, $responsavel, $telefone, $comprovante_nome, $produto_servico_id);

        if ($stmt->execute()) {
            $mensagem = "✅ Pagamento registrado com sucesso!";
        } else {
            $mensagem = "❌ Erro ao salvar no banco de dados.";
        }
    } else {
        $mensagem = "❌ Erro ao enviar o comprovante.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Pagamento</title>
    <style>
        body {background-color: #e5e3a5ff;
             font-family: Arial, sans-serif;
             padding: 20px;
             }

        form {max-width: 500px;
              margin: auto;
             }

        input, select { width: 100%; padding: 8px; margin: 10px 0; }
        .mensagem { text-align: center; font-weight: bold; margin: 20px 0; color: green; }
        .erro { color: red; }
        .botao-voltar {
            display: block;
            margin: 30px auto;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php if ($mensagem): ?>
    <div id="mensagem" class="mensagem <?php echo strpos($mensagem, '❌') !== false ? 'erro' : ''; ?>">
        <?php echo $mensagem; ?>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <label>CPF ou CNPJ:</label>
    <input type="text" name="cpf_cnpj" required>

    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>Responsável:</label>
    <input type="text" name="responsavel">

    <label>Telefone:</label>
    <input type="text" name="telefone">

    <label>Produto/Serviço:</label>
    <select name="produto_servico_id" required>
        <option value="">Selecione...</option>
        <?php
        $res = $conn->query("SELECT id, nome FROM produtos_servicos");
        while ($row = $res->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['nome']}</option>";
        }
        ?>
    </select>

    <label>Comprovante de Pagamento:</label>
    <input type="file" name="comprovante" accept=".jpg,.jpeg,.png,.pdf" required>

    <input type="submit" value="Salvar Pagamento">
</form>

<a href="sistema_empresa.php" class="botao-voltar">⬅ Voltar ao Sistema</a>

<!-- código para esmerecer a mensagem Pagamento registrado com sucesso! -->
 <script>
    setTimeout(function() {
        const msg = document.getElementById("mensagem");
        if (msg) {
            msg.style.display = "none";
        }
    }, 3000); // 3000 milissegundos = 3 segundos
</script>
</body>
</html>