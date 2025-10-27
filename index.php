<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            background-color: #e7dfdfff;
            text-align: center;
            padding-top: 50px;
        }
        .container {
            background-color: white;
            width: 400px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .message {
            color: green;
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            opacity: 1;
            transition: opacity 1s ease-out;
        }
        .message.fade-out {
            opacity: 0;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
<?php 
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        echo "<div class='message' id='logout-message'>
                <strong>Sessão encerrada com sucesso!</strong>
              </div>";
}
?>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required><br>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <input type="submit" value="Entrar">
    </form>
</div>

<script>
    setTimeout(function() {
        const msg = document.getElementById('logout-message');
        if (msg) {
            msg.classList.add('fade-out');
            setTimeout(() => {
                msg.style.display = 'none';
            }, 1000); // espera a transição terminar
        }
    }, 3000); // espera 4 segundos antes de começar a desaparecer
</script>

</body>
</html>