create database notes;
use notes;
create table note(
    id int(11) not null auto_increment,
    title varchar(100) not null,
    detail varchar(200) not null,
    primary key(id)
);