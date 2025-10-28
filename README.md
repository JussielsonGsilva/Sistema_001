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

