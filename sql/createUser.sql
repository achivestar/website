create user 'kkameun'@'localhost' identified by 'qkagksmf1!'

grant all privileges on *.* to 'kkameun'@'localhost'

create table greet(
    num int not null auto_increment primary key,
    id varchar(15) not null,
    name varchar(10) not null,
    nick varchar(10) not null,
    subject varchar(100) not null,
    content text not null,
    regist_day varchar(20),
    hit int,
    is_html char(1)
);

create table member(
    id varchar(15) not null,
    pass varchar(15) not null,
    name varchar(10) not null,
    nick varchar(10) not null,
    hp varchar(20) not null,
    email varchar(20) not null,
    regist_day varchar(20) not null,
    level int(11),
    primary key(id)
   );


create table memo(
    num int not null auto_increment,
    id varchar(15) not null,
    name varchar(10) not null,
    nick varchar(10) not null,
    content text not null,
    regist_day varchar(20),
    primary key(num)
);

create table memo_ripple(
    num int not null auto_increment,
    parent int not null,
    id varchar(15) not null,
    name varchar(10) not null,
    nick varchar(10) not null,
    content text not null,
    regist_day varchar(20),
    primary key(num)
);