#drop database if exists page;
#create database page;
#use page;
ALTER DATABASE CHARACTER SET utf8 COLLATE utf8_unicode_ci;

create table admin(
id int(11) primary key auto_increment,
username varchar(55) not null,
password char(32) not null,
email varchar(255) not null
)engine=InnoDB;

create table user(
id int(11) primary key auto_increment,
username varchar(55) not null,
password varchar(55) not null,
email varchar(255) not null,
created_at timestamp,
updated_at timestamp,
is_approved tinyint(1),
activation_key varchar (55) not null
)engine=InnoDB;

create table category(
id int primary key auto_increment,
title varchar (55) not null,
description varchar (55)not null,
created_at timestamp,
updated_at timestamp,
is_enabled tinyint(1)

)engine=InnoDB;

create table posts(
id int(11) primary key auto_increment,
content varchar(55) not null,
summary varchar(55) not null,
image varchar(200),
autor varchar(50),
created_at timestamp not null,
updated_at timestamp,
catg_ids varchar(55),
title varchar (55) not null,
is_enabled tinyint(1), 
category int,
user int
)engine=InnoDB;

create table comments(
id int(11) primary key auto_increment,
comment text not null,
created_at timestamp null,
created_by varchar(55) not null,
is_approved tinyint(1),
id_user int,
id_post int
)engine=InnoDB;

alter table comments add foreign key (id_user) references user(id);
alter table comments add foreign key (id_post) references posts(id);
alter table posts add foreign key (category) references category(id);
alter table posts add foreign key (user) references user(id);

INSERT INTO admin (username,password,email)
VALUES ('ante',md5('a'),'ante123@hotmail.com');




insert into user (username,password,email,created_at,updated_at,is_approved) values ("user",md5('u'),"probaproba@654.hr",CURRENT_TIMESTAMP,null,null);
insert into user (username,password,email,created_at,updated_at,is_approved) values ("user1",md5('u1'),"probaprob@a654.hr",CURRENT_TIMESTAMP,null,null);
insert into user (username,password,email,created_at,updated_at,is_approved) values ("user12",md5('u2'),"probap@roba345.hr",CURRENT_TIMESTAMP,null,null);
insert into user (username,password,email,created_at,updated_at,is_approved) values ("user123",md5('u3'),"probaprob1@22a.hr",CURRENT_TIMESTAMP,null,null);




insert into category (title,description,created_at,updated_at,is_enabled) values ("Title 1","Category description87", CURRENT_TIMESTAMP,null,1);
insert into category (title,description,created_at,updated_at,is_enabled) values ("Title 123","Category description21", CURRENT_TIMESTAMP,null,1);
insert into category (title,description,created_at,updated_at,is_enabled) values ("Title 12345","Category description345", CURRENT_TIMESTAMP,null,1);
insert into category (title,description,created_at,updated_at,is_enabled) values ("Title 134566","Category description3456", CURRENT_TIMESTAMP,null,1);



INSERT into posts (content,summary,image,created_at,updated_at,catg_ids,title,is_enabled,category,user) values ("Cras varius mi at luctus tempor . ", "Duis a dui ",null,CURRENT_TIMESTAMP,null,null,"Title 1",null,1,1);
INSERT into posts (content,summary,image,created_at,updated_at,catg_ids,title,is_enabled,category,user) values ("Cras varius mi at luctus tempor mi at luctus tempor. ", "Duis a dui ","null",CURRENT_TIMESTAMP,null,null,"Title 2",null,2,2);
INSERT into posts (content,summary,image,created_at,updated_at,catg_ids,title,is_enabled,category,user) values ("Cras varius mi at luctus tempor Cras varius mi at luctus tempor Cras varius mi at luctus tempor. ", "Duis a dui ","null",CURRENT_TIMESTAMP,null,null,"Title 3",null,3,2);
INSERT into posts (content,summary,image,created_at,updated_at,catg_ids,title,is_enabled,category,user) values ("Cras varius mi at luctus tempor Cras varius mi at luctus tempor. ", "Duis a dui ","null",CURRENT_TIMESTAMP,null,null,"Title 4",null,4,4);



insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 1', CURRENT_TIMESTAMP,"proba",1,null,1);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 2', CURRENT_TIMESTAMP,"proba",1,null,2);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 12', CURRENT_TIMESTAMP,"proba",1,null,3);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 13', CURRENT_TIMESTAMP,"proba",1,null,3);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 14', CURRENT_TIMESTAMP,"proba",1,null,3);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 15', CURRENT_TIMESTAMP,"proba",1,null,3);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 16', CURRENT_TIMESTAMP,"proba",1,null,3);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 17', CURRENT_TIMESTAMP,"proba",1,null,3);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 18', CURRENT_TIMESTAMP,"proba",1,null,3);
insert into comments (comment,created_at,created_by,is_approved,id_user,id_post) values ('Comment 12', CURRENT_TIMESTAMP,"proba",1,null,4);









