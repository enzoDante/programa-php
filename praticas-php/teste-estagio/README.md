=========tabela mysql===========
Dentro do arquivo "tabela.sql" terá todo o código sql comentado (código de criação do banco de dados, insert's e criação de tabelas)
<img src="imagens/2022-08-12-14-23-56_arquivo1" alt="">

-Criar o banco de dados"
create database registros_vendas;
use registros_vendas;
"
-criação das tabelas"
    create table produtos(
    id_produto varchar(100) not null primary key,
    nome_p varchar(100) not null,
    preco_p float not null,
    fornecedor varchar(300)
    );
    -----------------
    create table carrinho(
    id_carrinho int not null primary key auto_increment,
    id_produto varchar(100) not null
    );
    ----------------
    create table vendas(
    id_venda int not null primary key auto_increment,
    preco_total float not null,
    data_venda date not null,
    produtos varchar(1000),
    precos varchar(1000),
    cep varchar(100) not null,
    uf varchar(2) not null,
    cidade varchar(200) not null,
    bairro varchar(200) not null,
    rua varchar(200) not null,
    numero int
    );
"
-inserir na tabela produtos"
    insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('b1','tenis', 200.25, 'julho, adriana');
"
OBS: o id_produto é a referência!
OBS: ao inserir os fornecedores, pode-se colocar juntos exemp "'julho, adriana'"

-=-=-=-==-=--==--=-=--=--=--=-=-
Testar tela de venda:
a primeira página (index.html) está mostrando o passo a passo para testar o site
==========================================
Acesse a página "buscar produtos", no input, digite o nome ou a referência do produto, então adicione ao carrinho clicando no botão abaixo do produto

Acesse a págnia "finalizar compra" para preencher os campos do endereço, nessa mesma página, pode-se remover os produtos do carrinho! então clique no botão finalizar compra

Acesse a página "Histórico de compras" irá aparecer as vendas efetuadas pelo usuário (do mais recente para o mais antigo)