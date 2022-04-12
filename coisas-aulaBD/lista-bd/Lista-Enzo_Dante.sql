/*
Enzo Dante Mícoli 2H
lista

*/

#create database classroomlista02;
use classroomlista02;
/*
create table produtos(
id_produto int primary key not null,
descricao varchar(100) not null,
precoVenda float not null,
precoCusto float not null,
categoria int not null
);*/
#select * from produtos;
#categorias (1=caderno/livro|| 2=material|| 3=eletronicos )
/*
insert into produtos values(1, "cadernos", 20.99, 15.32, 1);
insert into produtos values(2, "O livro do senhor", 55.99, 42.32, 1);
insert into produtos values(3, "Calculadora", 99.99, 42.32, 3);
insert into produtos values(4, "estojo", 12.99, 21.32, 2);
insert into produtos values(5, "papel", 10.99, 5.11, 1);
insert into produtos values(6, "mouse gamer", 999.99, 1000, 3);
insert into produtos values(7, "caneta e lápis", 5.00, 5.01, 2);*/

#select descricao, precoVenda from produtos where precoVenda > 49.90;
#select (Round(precoVenda,2) - round(precoCusto,2)) from produtos where precoVenda > 5;
/*
create table categorias(
id_categoria int primary key not null,
id_c int not null,
qtd_estoque int not null,
nome_fornecedor varchar(200) not null
);
*/

#ALTER TABLE categorias ADD FOREIGN KEY (id_c) REFERENCES produtos(id_produto);
/*
insert into categorias values(1, 1, 200, "Bertinho");
insert into categorias values(2, 2, 600, "Cleitin");
insert into categorias values(3, 3, 20, "FerrariWags");*/

#select descricao, id_c, nome_fornecedor from produtos, categorias where categoria = id_c;

#select descricao, categoria, id_c from produtos, categorias where categoria = id_c and qtd_estoque > 10;
#select descricao, qtd_estoque, precoVenda from produtos, categorias where categoria = id_c and qtd_estoque < 25;
