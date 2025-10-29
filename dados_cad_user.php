<?php
session_start();
date_default_timezone_set('America/Fortaleza');
include("conexao.php");

$result = mysqli_query($conn, "SELECT usuario, criado_em, ultimo_login FROM usuarios ORDER BY criado_em DESC");
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
            margin-top: 20px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .voltar:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h2>Usuários Cadastrados</h2>
    <table class="tabela-usuarios">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Criado_em</th>
                <th>Ultimo_login</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['usuario']; ?></td>
                <td><?php echo $row['criado_em']; ?></td>
                <td><?php echo date("d/m/Y H:i", strtotime($row['ultimo_login'])); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="sistema_empresa.php" class="voltar">← Voltar ao Painel</a>

</body>
</html>