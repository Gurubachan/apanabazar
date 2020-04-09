alter table tbl_product
	add hsncode int not null after productname;
alter table tbl_vendors
	add vendormail varchar(50) not null after vendorcontacts;

create unique index tbl_vendors_vendormail_uindex
	on tbl_vendors (vendormail);
