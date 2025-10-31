<?php
session_start();
date_default_timezone_set('America/Fortaleza');
include("conexao.php");

// Implementando segurança à página, para ter acesso apenas usuários logados
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Processa o formulário
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo = $_POST['tipo'] ?? '';
    $nome = trim($_POST['nome'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = $_POST['preco'] ?? '';

    if ($tipo && $nome && $descricao && $preco !== "") {
        $sql = "INSERT INTO produtos_servicos (tipo, nome, descricao, preco, data_cadastro)
                VALUES ('$tipo', '$nome', '$descricao', '$preco', NOW())";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['mensagem'] = "✅ Cadastro realizado com sucesso!";
            $_SESSION['tipoClasse'] = "sucesso";
        } else {
            $_SESSION['mensagem'] = "❌ Erro ao cadastrar: " . mysqli_error($conn);
            $_SESSION['tipoClasse'] = "erro";
        }
    } else {
        $_SESSION['mensagem'] = "⚠️ Preencha todos os campos corretamente.";
        $_SESSION['tipoClasse'] = "alerta";
    }

    // Redireciona para evitar reenvio do formulário
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Exibe a mensagem após redirecionamento
$mensagem = $_SESSION['mensagem'] ?? "";
$tipoClasse = $_SESSION['tipoClasse'] ?? "";
unset($_SESSION['mensagem'], $_SESSION['tipoClasse']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos ou Serviços</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            margin-top: 50px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #34495e;
        }

        form input, form select, form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            margin-top: 20px;
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        .mensagem {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
        }

        .mensagem {
        /* interagindo com o código javascript */
            transition: opacity 0.5s ease-out;
        }


        .sucesso {
            background-color: #d4edda;
            color: #155724;
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
            margin: 20px auto 0;
            text-align: center;
            background-color: #3498db;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            width: fit-content;
        }

        .btn-voltar:hover {
            background-color: #2980b9;
        }

        .titulo{
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="titulo">
            <h2>Cadastro de Produtos ou Serviços</h2>
            <a href="sistema_empresa.php" class="btn-voltar">← Voltar ao Painel</a>
        </div>

        <?php if ($mensagem) { ?>
            <div class="mensagem <?php echo $tipoClasse; ?>"><?php echo $mensagem; ?></div>
        <?php } ?>

        <form method="POST" action="">
            <label>Tipo:</label>
            <select name="tipo" required>
                <option value="">Selecione</option>
                <option value="Produto">Produto</option>
                <option value="Serviço">Serviço</option>
            </select>

            <label>Nome:</label>
            <input type="text" name="nome" required>

            <label>Descrição:</label>
            <textarea name="descricao" rows="4" required></textarea>

            <label>Preço (R$):</label>
            <input type="number" name="preco" step="0.01" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
<!-- código javascript para esmerecer  a mensagem cadastro realizado com sucesso -->
 <script>
    setTimeout(function() {
        const msg = document.querySelector('.mensagem');
        if (msg) {
            msg.style.opacity = '0';
            setTimeout(() => msg.style.display = 'none', 500); // espera a transição terminar
        }
    }, 3000);
</script>
</body>
</html>