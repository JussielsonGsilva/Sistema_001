<?php
session_start();
include("conexao.php");

// Implementando segurança à página, para ter acesso apenas usuários logados
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$pesquisa = "";
$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pesquisa = trim($_POST['pesquisa']);

    $sql = "SELECT * FROM produtos_servicos 
            WHERE nome LIKE '%$pesquisa%' 
            OR tipo LIKE '%$pesquisa%' 
            ORDER BY data_cadastro DESC";

    $query = mysqli_query($conn, $sql);
    if ($query && mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $resultados[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pesquisar Produto/Serviço</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #d7dee4ff;
            padding: 40px;
        }

        .container {
            max-width: 950px;
            margin: auto;
            background-color: #eee8e8ff;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #ecf0f1;
        }

        .acoes a {
            margin-right: 10px;
            text-decoration: none;
            /* color: #3498db; */
            font-weight: bold;
        }

        .acoes a:hover {
            text-decoration: underline;
        }

        .btn-voltar {
            /* display: block; */
            margin-top: 16px;
            background-color: #c9c441ff;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            width: fit-content;
        }

        .btn-voltar:hover {
            background-color: #2980b9;
        }

        .cabecalho{
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0px 40px;
        }
        .excluir{
            color: red;
        }
        .btn_alterar{
            color: green;
        }
        .btn_excluir{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
            <div class="cabecalho">
            <h2>Pesquisar Produto ou Serviço:</h2>
            <a href="sistema_empresa.php" class="btn-voltar">← Voltar ao Painel</a>
            </div>
            <br>

        <form method="POST" action="">
            <input type="text" name="pesquisa" placeholder="Digite nome do Produto ou Serviço" value="<?php echo htmlspecialchars($pesquisa); ?>" required>
            <button type="submit">Pesquisar</button>
        </form>

        <?php if (!empty($resultados)) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço (R$)</th>
                        <th>Data_Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $item) { ?>
                    <!-- formatando a data -->
                     <?php
                        $data_format = new DateTime($item['data_cadastro']); 
                     ?>
                        <tr>
                            <td><?php echo $item['tipo']; ?></td>
                            <td><?php echo $item['nome']; ?></td>
                            <td><?php echo $item['descricao']; ?></td>
                            <td><?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo $data_format->format("d-m-Y à\s H:i"); ?></td>
                            <td class="acoes">
                                <a class="btn_alterar" href="alterar_produto_servico.php?id=<?php echo $item['id']; ?>">Alterar</a>
                                <a class="btn_excluir" href="deletar_produto_servico.php?id=<?php echo $item['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } elseif ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <p>Nenhum resultado encontrado para "<?php echo htmlspecialchars($pesquisa); ?>"</p>
        <?php } ?>
    </div>
</body>
</html>
