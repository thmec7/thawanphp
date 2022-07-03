-- https://dev.mysql.com/doc/refman/5.6/en/timestamp-initialization.html

create database if not exists sga;
use sga;

create or replace table usuario(
    id int primary key auto_increment,
    nome varchar(250) not null,
    animepreferido varchar(250) not null unique,
    email varchar(250) not null unique,
    idade int not null unique,
    created_at TIMESTAMP not null default CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

alter table usuario add column foto text not null default "imagens\\avatar.png" after nome;


create or replace table login(
    id int primary key auto_increment,
    email varchar(250) not null unique,
    senha varchar(255) not null,
    created_at TIMESTAMP not null default CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

insert into login(email, senha) values ('admin@senac.com.br', md5('admin@123'));
