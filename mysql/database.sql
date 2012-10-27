create database if not exists ideabox;
use ideabox;
create table if not exists skill
(
pkskill int auto_increment not null,
name TEXT not null,
PRIMARY KEY(pkskill)
);

create table if not exists usertype
(
pkusertype int auto_increment not null,
description TEXT not null,
PRIMARY KEY(pkusertype)
);

create table if not exists user
(
pkuser int auto_increment,
firstname TEXT not null,
lastname TEXT not null,
email TEXT not null,
fktype int not null,
description TEXT,
ispublic boolean not null,
PRIMARY KEY(pkuser),
FOREIGN KEY(fktype) references usertype(pkusertype)
);

create table if not exists assoc_user_skill
(
fkuser int not null,
fkskill int not null,
level int not null,
PRIMARY KEY(fkuser, fkskill),
FOREIGN KEY(fkuser) references user(pkuser),
FOREIGN KEY(fkskill) references skill(pkskill)
);

