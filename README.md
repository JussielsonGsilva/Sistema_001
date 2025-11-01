# Sistema_001
Sistema de Cadastro e Gestão de Produtos/Serviços

-Tecnologias utilizadas
html
css
javaScript
php
SGDB--> phpMyadmin

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

No arquivo sistema_empresa.php vamos Exibir o nome do usuário e a data-hora do último login
Menu fixo à esquerda com ícones e texto
Links com efeito hover e destaque
Visual limpo e moderno com cores profissionais

implementando a listagem de usuários no sistema empresarial.
criando o arquivo dados_cad_user.php
Conecta ao banco e busca os usuários
Exibe em uma tabela estilizada com cores suaves
Inclui botão de “Voltar ao Painel”
CSS embutido para facilitar testes e ajustes

Implementando o cadastro de Produtos/Serviços
criar a tabela produtos_servicos no phpMyadmin
CREATE TABLE produtos_servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('Produto', 'Serviço'),
    nome VARCHAR(100),
    descricao TEXT,
    preco DECIMAL(10,2),
    data_cadastro DATETIME
);

Criando o arquivo cadastro_produto_servico.php
Relatório centralizado com layout limpo
Botão de “Voltar ao Painel” estilizado
Tabela responsiva e organizada
Mensagem de sucesso/erro estilizada

Criando o arquivo pesquisar_produto_servico.php
onde vamos poder realizar uma pesquisa de um determinado produto ou um serviço
e com as opções de alterar ou deletar o produto ou um serviço

Pesquisar produtos ou serviços por nome ou tipo 
✅ Exibir os resultados em uma tabela 
✅ Oferecer botões para alterar ou deletar cada item

Criando o arquivo alterar_produto_servico.php
Carregar os dados do produto/serviço pelo id 
✅ Exibir os dados em um formulário para edição 
✅ Atualizar os dados no banco de dados após o envio

Criando o arquivo deletar_produto_servico.php
Exclui um item do banco e redireciona para a pesquisa com 
mensagem de sucesso ou erro.

Criando o arquivo gerar_pdf.php
Esse arquivo vai receber o id do produto/serviço 
buscar os dados no banco e gerar o PDF.

Realizando algumas melhorias no PDF
Adicionado a função de enviar o PDF para um e-mail
Utilizando a Biblioteca PHPMailer
Adicionando a chave pix para facilitar o pagamento

Criando a tabela pagamentos para receber os comprovantes
com chave estrangeira para lincar com a tabela produtos/serviços
CREATE TABLE pagamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf_cnpj VARCHAR(20) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    responsavel VARCHAR(100),
    telefone VARCHAR(20),
    comprovante_pagamento VARCHAR(255), -- caminho do arquivo ou nome
    produto_servico_id INT NOT NULL,    -- chave estrangeira
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_servico_id) REFERENCES produtos_servicos(id)
);

Criando o arquivo cadastrar_pagamento.php onde teremos o nosso formulário 
para realizar o cadastro

