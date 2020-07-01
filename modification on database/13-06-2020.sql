drop table tbl_usertype;
create table tbl_usertype
(
    id int auto_increment
        primary key,
    usertypename varchar(50)                          not null,
    entryby      int                                  not null,
    entryat      timestamp  default CURRENT_TIMESTAMP null,
    updateby     int                                  null,
    updateat     timestamp                            null,
    isactive     tinyint(1) default 1                 null
);