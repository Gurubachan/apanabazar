CREATE TABLE tbl_unit(
						 id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
						 unitname varchar(30) NOT NULL unique ,
						 entryby int not null,
						 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
						 updateby int default null,
						 updateat timestamp default null ,
						 isactive boolean DEFAULT true
);

CREATE TABLE tbl_inventory(
							  id bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
							  itemname varchar(100) NOT NULL  ,
							  productid int not null ,
							  branditemcode varchar(50) default null,
							  mrp float not null ,
							  saleprice float not null ,
							  discount float not null ,
							  taxrate float default 0,
							  unitid int not null ,
							  quantity int not null ,
							  dimension varchar(20) default null,
							  vendorid int not null,
							  brandid int not null ,
							  trackby int default null,
							  openingstock int not null ,
							  inwardstock int default 0,
							  outwardstock int default 0,
							  entryby int not null,
							  entryat timestamp DEFAULT CURRENT_TIMESTAMP,
							  updateby int default null,
							  updateat timestamp default null ,
							  isactive boolean DEFAULT true,
							  foreign key (productid) references tbl_product (id) on update cascade on delete restrict,
							  foreign key (unitid) references tbl_unit (id) on update cascade on delete restrict,
							  foreign key (vendorid) references tbl_vendors (id) on update cascade on delete restrict,
							  foreign key (brandid) references tbl_manufacturer (id) on update cascade on delete restrict
);
CREATE TABLE tbl_item_images(
								id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
								itemid bigint not null ,
								imagefullpath varchar(256) not null ,
								unique (itemid,imagefullpath),
								entryby int not null,
								entryat timestamp DEFAULT CURRENT_TIMESTAMP,
								updateby int default null,
								updateat timestamp default null ,
								isactive boolean DEFAULT true,
								foreign key (itemid) references tbl_inventory (id) on update cascade on delete restrict
);
CREATE TABLE tbl_batch(
						  id bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
						  itemid bigint not null ,
						  uniquecode varchar(50) not null ,
						  unique (itemid,uniquecode),
						  quantity int not null ,
						  mrp float not null ,
						  manfactdate date not null ,
						  expdate date not null ,
						  outstock int default 0,
						  remainstock int default 0,
						  entryby int not null,
						  entryat timestamp DEFAULT CURRENT_TIMESTAMP,
						  updateby int default null,
						  updateat timestamp default null ,
						  isactive boolean DEFAULT true,
						  foreign key (itemid) references tbl_inventory (id) on update cascade on delete restrict
);
CREATE TABLE tbl_attribute_group(
									id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
									name varchar(20) not null unique ,
									description varchar(100) not null ,
									productid int not null ,
									entryby int not null,
									entryat timestamp DEFAULT CURRENT_TIMESTAMP,
									updateby int default null,
									updateat timestamp default null ,
									isactive boolean DEFAULT true,
									foreign key (productid) references tbl_product (id) on update cascade on delete restrict
);
CREATE TABLE tbl_attribute(
							  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
							  name varchar(20) not null ,
							  attributegroupid int not null ,
							  entryby int not null,
							  entryat timestamp DEFAULT CURRENT_TIMESTAMP,
							  updateby int default null,
							  updateat timestamp default null ,
							  isactive boolean DEFAULT true,
							  foreign key (attributegroupid) references tbl_attribute_group (id) on update cascade on delete restrict
);
CREATE TABLE tbl_item_variant(
								 id bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
								 attributeid int not null ,
								 itemid bigint not null ,
								 variantdetails varchar(20) not null ,
								 entryby int not null,
								 entryat timestamp DEFAULT CURRENT_TIMESTAMP,
								 updateby int default null,
								 updateat timestamp default null ,
								 isactive boolean DEFAULT true,
								 foreign key (attributeid) references tbl_attribute (id) on update cascade on delete restrict,
								 foreign key (itemid) references tbl_inventory (id) on update cascade on delete restrict
);
alter table tbl_inventory modify trackby varchar(20) default null null;

