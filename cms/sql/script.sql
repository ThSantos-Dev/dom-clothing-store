create database db_dom;
use db_dom;

create table tbl_contatos (
	id_contato int not null auto_increment primary key,
    nome varchar(80) not null,
    telefone varchar(18),
    email varchar(80) not null,
    obs text,
    atualizaoes_email boolean
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
            "Yudi Playstation",
            "(11)40028922",
            "yudi.praysteition@gmail.com",
            "Bora ganha um prayzinho???",
            false
        );
        
select * from tbl_contatos;