drop database pepemusic;
create database pepemusic;
use pepemusic;


create table titular(
	objref int not null primary key auto_increment,
	nome varchar(255),
	codecad varchar(255),
	tipopessoa varchar(10),
	nomefantasia varchar(255),
	sexo varchar(10),
	dtnascimento date 
);


create table obra(
	objref int not null primary key auto_increment,
	titulo varchar(255),
	codecad varchar(255),
	dtregistro date
);


create table obratitular(
objref int not null primary key auto_increment,
objref_titular int not null,
objref_obra int not null,
percentual double not null,
constraint foreign key(objref_titular) references titular(objref), 
constraint foreign key(objref_obra) references obra(objref) 
);

