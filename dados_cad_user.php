<?php
session_start();
date_default_timezone_set('America/Fortaleza');
include("conexao.php");

$result = mysqli_query($conn, "SELECT usuario, criado_em, ultimo_login FROM usuarios ORDER BY ultimo_login DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários Cadastrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .tabela-usuarios {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .tabela-usuarios th, .tabela-usuarios td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .tabela-usuarios th {
            background-color: #3498db;
            color: white;
        }

        .tabela-usuarios tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .voltar {
            display: inline-block;
            margin-top: 8px;
            margin-left: 500px;
            text-decoration: none;
            background-color: #64a248ff;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .voltar:hover {
            background-color: #2980b9;
        }

        .cabecalho{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

    </style>
</head>
<body>
    <div class="cabecalho">
        <h2>Usuários Cadastrados</h2>
        <a href="sistema_empresa.php" class="voltar">← Voltar ao Painel</a>
    </div>
    <table class="tabela-usuarios">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Criado em</th>
                <th>Último Login</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                <td>
                    <?php
                        // Removido UTC pois os dados já estão no fuso correto
                        $dtCriado = new DateTime($row['criado_em']);
                        echo $dtCriado->format("d/m/Y H:i");
                    ?>
                </td>
                <td>
                    <?php
                        $dtLogin = new DateTime($row['ultimo_login']);
                        echo $dtLogin->format("d/m/Y H:i");
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- <a href="sistema_empresa.php" class="voltar">← Voltar ao Painel</a> -->

</body>
</html>
