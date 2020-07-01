alter table tbl_category
	add `order` int null after description;
alter table tbl_sub_category
	add `order` int null after description;
alter table tbl_product
	add `order` int null after description;
