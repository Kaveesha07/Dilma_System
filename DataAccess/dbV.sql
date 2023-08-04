-- create database
create database dilmaSystem;
-- use database
use dilmaSystem;

-- create table with primary key
create table SystemOperator(
	operatorId int auto_increment,
    operatorName varchar(100),
    operatorEmail varchar(50),
    username varchar(50),
    password varchar(50),
    constraint PK_Operator primary key(operatorId)
);

create table Item(
	itmNo varchar(30),
    itmName varchar(50),
    itmDesc varchar(100),
    itmPrice double,
    constraint PK_Item primary key(itmNo)
);

create table Supplier(
	supId varchar(30),
    supName varchar(50),
    supEmail varchar(100),
    constraint PK_Supplier primary key(supId)
);

create table Inventory(
	poLineId varchar(30),
    poNumber varchar(30),
    itemNo varchar(30),
    onHandStock double,
    approvedStock double,
    rejectedStock double
);

create table SalesRep(
	salesRepNo varchar(30),
    salesRepName varchar(50),
    salesRepEmail varchar(100),
    constraint PK_SalesRep primary key(salesRepNo)
);

create table purchaseorder(
	poNo varchar(30),
    popNo varchar(30),
    date date,
    status varchar(30),
    total double,
    constraint PK_POr primary key(poNo)
);

