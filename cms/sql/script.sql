create database db_dom;
use db_dom;

create table tbl_contatos (
	id_contato int not null auto_increment primary key,
    nome varchar(80) not null,
    telefone varchar(18),
    email varchar(80) not null,
    obs text,
    atualizacoes_email boolean
);

drop table tbl_contatos;

desc tbl_contatos;

insert into tbl_contatos (
            nome,
            telefone,
            email,
            obs,
            atualizaoes_email
        ) 
        values (
            "Me ferrei",
            "(11)k k kk k",
            "me ferrei@gmail.com",
            "hahahah ahahahah ahaha???",
            0
        );
        
select * from tbl_contatos;

create table tbl_categorias(
	id_categoria int not null auto_increment primary key,
    nome varchar(80) not null
);

insert into tbl_categorias(nome)values('camisetas');

select * from tbl_categorias;

update tbl_categorias set nome= 'teste 2 editado' where id_categoria = 9


	
