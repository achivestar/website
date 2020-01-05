create table gallery(
                        num int not null auto_increment,
                        subject varchar(30) not null,
                        file_name_0 varchar(40),
                        file_name_1 varchar(40),
                        file_name_2 varchar(40),
                        file_copied_0 varchar(40),
                        file_copied_1 varchar(40),
                        file_copied_2 varchar(40),
                        primary key(num)
);