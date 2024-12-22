create table pemweb.akun(
	id int not null primary key auto_increment,
	email varchar(255) not null unique key,
	username varchar(10) not null unique key,
	password varchar(10)
)

create table pemweb.admin(
	id int not null primary key auto_increment,
	username varchar(10) not null unique key,
	password varchar(10)

)