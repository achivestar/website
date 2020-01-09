create table survey(
                       num int not null auto_increment primary key,
                       subject varchar(100) not null,
                       class_name_0 varchar(30),
                       class_name_1 varchar(30),
                       class_name_2 varchar(30),
                       class_name_3 varchar(30),
                       class_name_4 varchar(30),
                       point_0 int,
                       point_1 int,
                       point_2 int,
                       point_3 int,
                       point_4 int
);

insert into survey (subject,class_name_0,class_name_1,class_name_2,class_name_3,point_0,point_1,point_2,point_3) values
('가장 좋아하는 기타 작곡가는?','타레가','빌라로보스','끌레양','소르',10,42,53,13);