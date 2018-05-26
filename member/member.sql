  create table member (
  id    char(10) not null,
  pw  char(15) not null,
  name  char(10) not null,
  hp    char(20)  not null,
  email char(80),
  birth_day char(10),
  level int,
  primary key(id)
  );
