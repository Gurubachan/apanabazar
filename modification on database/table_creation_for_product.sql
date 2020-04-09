CREATE TABLE tbl_company(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(200) NOT NULL,
    address varchar(200) ,
    pannumber varchar(10) NOT null UNIQUE,
    gstnumber varchar(20) NOT null UNIQUE,
    logo varchar(256) DEFAULT null,
    entryby int not null,
    entryat timestamp DEFAULT CURRENT_TIMESTAMP,
    updateby int default null,
    updateat timestamp default null ,
    isactive boolean DEFAULT true
);
CREATE TABLE tbl_category(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    categoryname varchar(50) NOT NULL unique ,
    categoryimage varchar (256) default null,
    description varchar(500) default null,
    entryby int not null,
    entryat timestamp DEFAULT CURRENT_TIMESTAMP,
    updateby int default null,
    updateat timestamp default null ,
    isactive boolean DEFAULT true
);
CREATE TABLE tbl_sub_category(
			 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
			 catid int not null  ,
			 subcategoryname varchar(50) NOT NULL unique ,
			 subcategoryimage varchar (256) default null,
				description varchar(500) default null,
			 entryby int not null,
			 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
			 updateby int default null,
			 updateat timestamp default null ,
			 isactive boolean DEFAULT true,
			 foreign key(catid) references tbl_category(id) on delete restrict on update cascade
);
CREATE TABLE tbl_product(
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	subcatid int not null ,
    productname varchar(50) NOT NULL,
    unique (subcatid,productname),
    productimage varchar (256) default null,
	description varchar(500) default null,
    entryby int not null,
    entryat timestamp DEFAULT CURRENT_TIMESTAMP,
    updateby int default null,
    updateat timestamp default null ,
    isactive boolean DEFAULT true,
    foreign key(subcatid) references tbl_sub_category(id) on delete restrict on update cascade
);





