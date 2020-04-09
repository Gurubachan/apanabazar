create table tbl_usertype (
    id int not null primary key auto_increment,
    companyid int not null ,
    usertypename varchar(50) not null ,
    unique(companyid,usertypename),
    entryby int not null,
    entryat timestamp DEFAULT CURRENT_TIMESTAMP,
    updateby int default null,
    updateat timestamp default null ,
    isactive boolean DEFAULT true,
    foreign key (companyid) references tbl_company(id) on update cascade on delete restrict
);
create table tbl_admin(
	  id int not null primary key auto_increment,
	  companyid int not null ,
	  name varchar(50) not null ,
	  contactnumber bigint not null unique ,
	  contactverified boolean default false,
	  emailid varchar(50) not null unique,
	  emailverified boolean default false,
	  address varchar(200) default null,
	  auth varchar(256) default null,
	  authactive boolean default false,
	  iscomplete boolean default false,
	  entryby int not null,
	  entryat timestamp DEFAULT CURRENT_TIMESTAMP,
	  updateby int default null,
	  updateat timestamp default null ,
	  isactive boolean DEFAULT true,
	  foreign key (companyid) references tbl_company(id) on update cascade on delete restrict
);
create table tbl_vendor_type(
								id smallint not null primary key auto_increment,
								typename varchar(50) not null unique ,
								entryby int not null,
								entryat timestamp DEFAULT CURRENT_TIMESTAMP,
								updateby int default null,
								updateat timestamp default null ,
								isactive boolean DEFAULT true
);
create table tbl_vendors(
							id int not null primary key auto_increment,
							vendortypeid smallint not null ,
							regnumber varchar(20) not null unique ,
							vendorname varchar(100) not null ,
							vendoraddress varchar(200) default null,
							vendorcontacts bigint not null unique ,
							altcontact bigint default 0,
							ownername varchar(50) not null ,
							pincode int(6) default null,
							photograph varchar(256) default null,
							gstnumber varchar(20) default null,
							pannumber varchar(10) default null,
							aadharnumber varchar(12) default null,
							companydetails json ,
							flagid smallint not null ,
							auth varchar(256) default null,
							authactive boolean default false,
							iscomplete boolean default false,
							entryby int not null,
							entryat timestamp DEFAULT CURRENT_TIMESTAMP,
							updateby int default null,
							updateat timestamp default null ,
							isactive boolean DEFAULT true,
							foreign key (vendortypeid) references tbl_vendor_type(id) on update cascade on delete restrict ,
							foreign key (flagid) references tbl_vendor_flag(id) on update cascade on delete restrict
);
CREATE TABLE tbl_manufacturer(
								 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
								 productid int not null ,
								 manufacturer varchar(50) NOT NULL,
								 image varchar (256) default null,
								 description varchar(500) default null,
								 entryby int not null,
								 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
								 updateby int default null,
								 updateat timestamp default null ,
								 isactive boolean DEFAULT true,
								 foreign key (productid) references tbl_product(id) on update cascade on delete restrict
);
CREATE TABLE tbl_product_creation(
									 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
									 vendorid int not null ,
									 productid int not null  ,
									 productcode varchar(20) not null unique ,
									 manufacturerid int NOT NULL,
									 itemname varchar(100) NOT NULL,
									 itemcode varchar(50) NOT NULL,
									 hsnsaccode varchar(50) NOT NULL,
									 istaxable boolean default true,
									 taxpercentage float default null,
									 saleprice float not null,
									 discountapplicable boolean default true ,
									 couponapplicable boolean default true ,
									 deleverable boolean default true ,
									 productdescription longtext not null ,
									 productspecefication json ,
									 entryby int not null,
									 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
									 updateby int default null,
									 updateat timestamp default null ,
									 isactive boolean DEFAULT true,
									 foreign key(vendorid) references tbl_vendors(id) on delete restrict on update cascade,
									 foreign key(productid) references tbl_product(id) on delete restrict on update cascade,
									 foreign key(manufacturerid) references tbl_manufacturer(id) on delete restrict on update cascade
);
create table tbl_vendor_bank_details(
										id int not null primary key auto_increment,
										vendorid int not null ,
										bankname varchar(100) not null ,
										accountholdername varchar(100) not null ,
										ifsccode varchar(11) not null ,
										accountnumber varchar(20) not null unique ,
										entryby int not null,
										entryat timestamp DEFAULT CURRENT_TIMESTAMP,
										updateby int default null,
										updateat timestamp default null ,
										isactive boolean DEFAULT true,
										foreign key(vendorid) references tbl_vendors(id) on delete restrict on update cascade
);
CREATE TABLE tbl_manufacturer(
								 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
								 manufacturer varchar(50) NOT NULL,
								 image varchar (256) default null,
								 description varchar(500) default null,
								 entryby int not null,
								 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
								 updateby int default null,
								 updateat timestamp default null ,
								 isactive boolean DEFAULT true
);



