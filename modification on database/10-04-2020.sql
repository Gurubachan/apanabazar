create table tbl_item_summary(
								 id bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
								 itemid bigint not null ,
								 openingstock int not null ,
								 stockinward int,
								 stockoutward int,
								 remain int,
								 entryby int not null,
								 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
								 updateby int default null,
								 updateat timestamp default null ,
								 isactive boolean DEFAULT true,
								 foreign key (itemid) references tbl_inventory (id) on update cascade on delete restrict
);
create table tbl_user(
						 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
						 firstname varchar(30) not null ,
						 middlename varchar(30) default null,
						 lastname varchar(30) not null ,
						 mobile bigint not null unique ,
						 emailid varchar(50) not null unique ,
						 gender smallint not null ,
						 pancard varchar(10) default null,
						 ismailverified boolean default false,
						 ismobileverified boolean default false,
						 entryby int not null,
						 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
						 updateby int default null,
						 updateat timestamp default null ,
						 isactive boolean DEFAULT true
);
CREATE TABLE tbl_state(
						  id smallint NOT NULL PRIMARY KEY AUTO_INCREMENT,
						  name varchar(25) not null unique ,
						  code varchar(2) not null unique ,
						  entryby int not null,
						  entryat timestamp DEFAULT CURRENT_TIMESTAMP,
						  updateby int default null,
						  updateat timestamp default null ,
						  isactive boolean DEFAULT true
);
CREATE TABLE tbl_district(
							 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
							 name varchar(30) not null ,
							 code varchar(3) not null unique ,
							 stateid smallint not null ,
							 unique (stateid,name),
							 entryby int not null,
							 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
							 updateby int default null,
							 updateat timestamp default null ,
							 isactive boolean DEFAULT true,
							 foreign key (stateid) references tbl_state(id) on update cascade on delete restrict
);
CREATE TABLE tbl_city(
						 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
						 name varchar(30) not null ,
						 code varchar(4) not null unique ,
						 districtid int not null ,
						 unique (districtid,name),
						 entryby int not null,
						 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
						 updateby int default null,
						 updateat timestamp default null ,
						 isactive boolean DEFAULT true,
						 foreign key (districtid) references tbl_district(id) on update cascade on delete restrict
);
create table tbl_delivery_address(
									 id bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
									 pincode varchar(6) not null ,
									 address1 text,
									 address2 text,
									 city int not null ,
									 state smallint not null ,
									 landmark varchar(100) default null,
									 name varchar(50) not null ,
									 mobile bigint not null ,
									 altmobile bigint default null,
									 addresstype smallint not null ,
									 userid int not null ,
									 entryby int not null,
									 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
									 updateby int default null,
									 updateat timestamp default null ,
									 isactive boolean DEFAULT true,
									 foreign key (userid) references tbl_user(id) on update cascade on delete restrict,
									 foreign key (state) references tbl_state(id) on update cascade on delete restrict,
									 foreign key (city) references tbl_city(id) on update cascade on delete restrict
);
