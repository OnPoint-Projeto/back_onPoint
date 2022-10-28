create database bd_onpoint;
use bd_onpoint;

-- ATENCAO!!! QUANDO FOR CRIAR O BANCO LEMBRE-SE DE CRIAR O TRIGGER ABAIXO DO DELIMITER!!!
-- drop database bd_onpoint;

create table usuario(
id int unsigned auto_increment not null primary key,
nome varchar(80) not null,
email varchar(80) not null,
senha varchar(40) not null
)engine=innodb;
select * from usuario;
create table guarda(
id int unsigned auto_increment not null primary key,
id_usuario int unsigned not null,
foreign key(id_usuario) references usuario(id)
)engine=innodb;
select * from guarda;
create table item(
id int unsigned auto_increment not null primary key,
nome varchar(100) not null,
descricao varchar(150),
arquivo blob,
id_guarda int unsigned not null,
foreign key(id_guarda) references guarda(id)
)engine=innodb;
select * from item;
create table ajudar(
id int unsigned auto_increment not null primary key,
evento varchar(50),
estilo varchar(20),
horario time,
clima varchar(50),
descricao varchar(100),
id_guarda int unsigned not null,
id_usuarior int unsigned not null,
id_usuarioe int unsigned not null,
foreign key(id_guarda) references guarda(id),
foreign key(id_usuarior) references usuario(id),
foreign key(id_usuarioe) references usuario(id)
)engine=innodb;
select * from ajudar;
create table look(
id int unsigned auto_increment not null primary key,
nome varchar(100) not null,
descricao varchar(150),
item_1 blob,
item_2 blob,
item_3 blob,
item_4 blob,
id_usuario int unsigned not null,
foreign key(id_usuario) references usuario(id)
)engine=innodb;
/* deletar todas os dados das tabelas*/
delete from ajudar where id != 0;
delete from look where id != 0;
delete from item where id != 0;
delete from guarda where id != 0;
delete from usuario where id != 0;
*/
delimiter $$

CREATE DEFINER = CURRENT_USER TRIGGER `bd_onpoint`.`usuario_AFTER_INSERT` AFTER INSERT ON `usuario` FOR EACH ROW
BEGIN
 insert into guarda values (null,new.id);
END
$$ 







