create table tbl_item
(
    id            bigint auto_increment primary key,
    productid     int                                  not null,
    brandid       int                                  not null,
    itemname      varchar(100)                         not null,
    mrp           float                                not null,
    taxrate       float      default 0                 null,
    unitid        int                                  not null,
    quantity      int                                  not null,
    dimension     varchar(20)                          null,
    islive        boolean  default true,
    iscustome     boolean default false,
    entryby       int                                  not null,
    entryat       timestamp  default CURRENT_TIMESTAMP null,
    updateby      int                                  null,
    updateat      timestamp                            null,
    isactive      tinyint(1) default 1                 null,
    foreign key (productid) references tbl_product (id) on update cascade on delete restrict,
    foreign key (unitid) references tbl_unit (id) on update cascade on delete restrict,
    foreign key (brandid) references tbl_manufacturer (id) on update cascade on delete restrict
);
alter table tbl_inventory drop foreign key tbl_inventory_ibfk_1;

alter table tbl_inventory drop foreign key tbl_inventory_ibfk_2;

alter table tbl_inventory drop foreign key tbl_inventory_ibfk_3;

alter table tbl_inventory drop foreign key tbl_inventory_ibfk_4;

alter table tbl_item_images drop foreign key tbl_item_images_ibfk_1;
alter table tbl_item_images
    add constraint tbl_item_images_ibfk_1
        foreign key (itemid) references tbl_item (id)
            on update cascade on delete restrict;

alter table tbl_item_summary drop foreign key tbl_item_summary_ibfk_1;
alter table tbl_item_summary
    add constraint tbl_item_summary_ibfk_1
        foreign key (itemid) references tbl_item (id)
            on update cascade on delete restrict;

alter table tbl_item_variant drop foreign key tbl_item_variant_ibfk_2;
alter table tbl_item_variant
    add constraint tbl_item_variant_ibfk_2
        foreign key (itemid) references tbl_item (id)
            on update cascade on delete restrict;

alter table tbl_batch drop foreign key tbl_batch_ibfk_1;
alter table tbl_batch
    add constraint tbl_batch_ibfk_1
        foreign key (itemid) references tbl_item (id)
            on update cascade on delete restrict;

drop table tbl_inventory;
create table tbl_inventory
(
    id            bigint auto_increment primary key,
    itemid        bigint                               not null,
    vendorid      int                                  not null,
    saleprice     float                                not null,
    discount      varchar(10)                          null,
    openingstock  int                                  not null,
    inwardstock   int        default 0                 null,
    outwardstock  int        default 0                 null,
    trackby       smallint                             null,
    entryby       int                                  not null,
    entryat       timestamp  default CURRENT_TIMESTAMP null,
    updateby      int                                  null,
    updateat      timestamp                            null,
    isactive      tinyint(1) default 1                 null,
    foreign key (itemid) references tbl_item (id) on update cascade on delete restrict,
    foreign key (vendorid) references tbl_vendors (id) on update cascade on delete restrict
);

