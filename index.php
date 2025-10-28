<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página de Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            margin-top: 10px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #45a049;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
        .register-link a {
            color: #007BFF;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .message {
            color: green;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }

        .message {
            color: green;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
            opacity: 1;
            transition: opacity 1s ease-out;
        }
        .message.fade-out {
            opacity: 0;
        }


    </style>
</head>
<body>

<div class="login-container">
    <?php
        if(isset($_GET['logout']) && $_GET['logout'] == 1) {
            echo "<div class='message' id='logout-message'>
                    <strong>Sessão encerrada com sucesso!</strong>
                  </div>";}
    ?>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Logar</button>
    </form>
    <div class="register-link">
        <p>Ainda não é cadastrado? <a href="cadastro.html">Cadastre-se aqui</a></p>
    </div>
</div>
<!-- script para esmerecer a mensagem 'Sessão encerrada com sucesso!' -->
<script>
    setTimeout(function() {
        const msg = document.getElementById('logout-message');
        if (msg) {
            msg.classList.add('fade-out');
            setTimeout(() => {
                msg.style.display = 'none';
            }, 1000); // espera a transição terminar
        }
    }, 2000); // espera 4 segundos antes de começar a desaparecer
</script>


</body>
</html>