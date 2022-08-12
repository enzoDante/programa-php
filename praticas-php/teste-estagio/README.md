=========tabela mysql===========
Dentro do arquivo "tabela.sql" terá todo o código sql comentado (código de criação do banco de dados, insert's e criação de tabelas)<br>
<img src="imagens/2022-08-12-14-23-56_arquivo1" alt="">

-Criar o banco de dados"<br>
create database registros_vendas;<br>
use registros_vendas;<br>
"
-criação das tabelas"<br>
    create table produtos(<br>
    id_produto varchar(100) not null primary key,<br>
    nome_p varchar(100) not null,<br>
    preco_p float not null,<br>
    fornecedor varchar(300)<br>
    );<br>
    -----------------<br>
    create table carrinho(<br>
    id_carrinho int not null primary key auto_increment,<br>
    id_produto varchar(100) not null<br>
    );<br>
    ----------------<br>
    create table vendas(<br>
    id_venda int not null primary key auto_increment,<br>
    preco_total float not null,<br>
    data_venda date not null,<br>
    produtos varchar(1000),<br>
    precos varchar(1000),<br>
    cep varchar(100) not null,<br>
    uf varchar(2) not null,<br>
    cidade varchar(200) not null,<br>
    bairro varchar(200) not null,<br>
    rua varchar(200) not null,<br>
    numero int<br>
    );<br>
"
-inserir na tabela produtos"<br>
    insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('b1','tenis', 200.25, 'julho, adriana');
"<br>
OBS: o id_produto é a referência!<br>
OBS: ao inserir os fornecedores, devem ser colocados juntos exemp "'julho, adriana, gustavo'"

-=-=-=-==-=--==--=-=--=--=--=-=-<br>
Testar tela de venda:<br>
==========================================
a primeira página (index.html) está mostrando o passo a passo para testar o site

Acesse a página "buscar produtos", no input, digite o nome ou a referência do produto, então adicione ao carrinho clicando no botão abaixo do produto

Acesse a págnia "finalizar compra" para preencher os campos do endereço, nessa mesma página, pode-se remover os produtos do carrinho! então clique no botão finalizar compra

Acesse a página "Histórico de compras" irá aparecer as vendas efetuadas pelo usuário (do mais recente para o mais antigo)