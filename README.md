# Sistema_001
Sistema de Cadastro e Gestão de Produtos/Serviços

arquivo index.php
-Exibir um formulário de login com campos de usuário e senha
-Um botão de "Logar"
-Mostrar um link para a página de cadastro

Banco de dados criado no PhpMyadmin
Nome do Banco sistema_login
Nome da Tabela usuarios

-- Criar o banco de dados
CREATE DATABASE sistema_login CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Usar o banco de dados
USE sistema_login;

-- Criar a tabela de usuários
CREATE TABLE usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);


Aqurivo conexao.php
Usa mysqli para conectar ao banco
Verifica se a conexão foi bem-sucedida
Pode ser incluído em outros arquivos com include 'conexao.php';

Criando o arquivo cadastro.html
Onde o usuário irá inserir seus dados

Arquivo cadastro.php
Recebe os dados do cadastro.html
Criptografa a senha com password_hash()
Insere os dados na tabela usuarios usando prepared statements (mais seguro contra SQL injection)

Criando o arquivo sistema_empresa.html
O botão “Sair” irá conduzir a um arqivo logout.php que encerra a sessão, evitando que o sistema seja acessado diretamente sem o usuário realizar o login.

Protegendo a página com login
Etapas para proteger a página com login:
Transformar sistema_empresa.html em sistema_empresa.php
Iniciar a sessão com session_start()
Verificar se o usuário está logado
Redirecionar para o login se não estiver autenticado

session_start() inicia a sessão
Verifica se $_SESSION['usuario'] existe
Se não existir, redireciona para index.php
Se estiver logado, mostra o nome do usuário e a página protegida

Criando o arquivo login.php para verificar e validar os dados recebidos de index.php
Verifica se o usuário existe
Compara a senha digitada com a senha criptografada no banco
Se estiver tudo certo, inicia a sessão e redireciona
Se estiver errado, mostra uma mensagem estilizada com botão de voltar

Criando o arquivo logout.php
Finaliza a sessão do usuário
Remove os dados de login da memória
Redireciona o usuário para a tela de login ou página inicial
Sem ele, o botão “Sair” não faz nada — ou pior, o usuário continua logado mesmo depois de clicar.

O usuário clica em “Sair”
A sessão é encerrada
Ele volta para a tela de login
Se tentar acessar sistema_empresa.php sem estar logado, será bloqueado

Vamos implementar o horário do login
Adicionar uma coluna ultimo_login na tabela usuarios
Atualizar o login.php para salvar a data e hora
Usar date() para gerar o horário no formato desejado

