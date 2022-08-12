#create database registros_vendas;
use registros_vendas;
/*
create table produtos(
id_produto varchar(100) not null primary key,
nome_p varchar(100) not null,
preco_p float not null,
fornecedor varchar(300)
);*//*
create table carrinho(
id_carrinho int not null primary key auto_increment,
id_produto varchar(100) not null
);*//*
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
);*/
#inserir na tabela produtos
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('a1','cama', 500.99, 'Roberto');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('b1','tenis', 200.25, 'julho, adriana');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('a2','copo', 50.99, '');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('c3','cobertor', 199.99, 'julia');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('a23','Carro Fusca', 22099.99, 'Augusto, Ricardo');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('c34','teclado', 299.99, 'Roberto, julho');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('dg2','geladeira', 199.99, 'Fábio');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('b5','panela de aço', 199.99, '');
#insert into produtos (id_produto, nome_p, preco_p, fornecedor) values('sds2','radiador 25mm para ventoinhas de 12cm', 39.99, 'Giorge');

#código para ver as tabelas
#select * from produtos;
#select * from carrinho;
#select * from vendas;
#select * from produtos where nome_p like '%ca%' or id_produto like '%d%';