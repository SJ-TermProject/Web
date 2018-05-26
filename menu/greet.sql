create table greet (
  num int not null auto_incremnet,
  id char (15) not null,
  name char(10) not null,
  subject char(100) not null,
  content text not null,
  regist_day char(20),
  hit int,
  is_html char(1),
  primary key(num)
);
